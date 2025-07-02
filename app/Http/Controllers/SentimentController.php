<?php

namespace App\Http\Controllers;

use App\Models\AnalisaData;
use App\Models\DetailSentimen;
use App\Models\HasilAkurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SentimentController extends Controller
{
    protected $apiUrl = 'http://localhost:5000/api/check-model';
    protected $uploadApiUrl = 'http://localhost:5000/api/upload-file';

    public function index()
    {
        return view('sentimen.form');
    }

    public function uploadCsvForm()
    {
        return view('sentimen.upload');
    }

    public function predictText(Request $request)
    {
        $request->validate(['text' => 'required|string']);

        try {
            $textLines = array_filter(
                preg_split('/\r\n|\r|\n/', $request->text),
                fn($line) => trim($line) !== ''
            );

            if (empty($textLines)) {
                $textLines = [trim($request->text)];
            }

            $response = Http::post($this->apiUrl, ['texts' => $textLines]);
            if (!$response->successful()) {
                throw new \Exception('API Error: ' . $response->status());
            }

            $result = $response->json();
            $analisa = $this->saveTextAnalysis($textLines, $result);

            return view('sentimen.hasil', [
                'result' => $result,
                'textLines' => $textLines,
                'analisa_id' => $analisa->id,
                'chart_base64' => $result['visualizations']['pie_chart'] ?? null,
                'sentiment_distribution' => $result['metrics']['sentiment_distribution'] ?? null,
                'execution_time' => [
                    'NaiveBayes' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0,
                    'KNN' => $result['metrics']['execution_time']['KNN'] ?? 0
                ],
                'visualizations' => $result['visualizations'] ?? [],
                'predictions' => $result['results']
            ]);
        } catch (\Exception $e) {
            Log::error('Error predicting text: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function processCsv(Request $request)
    {
        $request->validate(['csv_file' => 'required|file|mimes:csv,txt|max:2048']);

        try {
            $file = $request->file('csv_file');
            $fileContent = file_get_contents($file->getRealPath());
            $groundTruthKey = $this->detectGroundTruthColumn($file->getRealPath());

            $response = Http::attach(
                'file',
                $fileContent,
                $file->getClientOriginalName()
            )->post($this->uploadApiUrl);

            if (!$response->successful()) {
                throw new \Exception('API Error: ' . $response->status() . ' - ' . $response->body());
            }

            $result = $response->json();
            // dd($result);
            $processedResults = $this->processApiResults($result);
            $analisa = $this->saveFileAnalysis($file, $result, !is_null($groundTruthKey));

            $hasGroundTruth = !is_null($groundTruthKey) ||
                (isset($result['metrics']['has_ground_truth']) && $result['metrics']['has_ground_truth']);

            return view('sentimen.hasil_csv', [
                'result' => $result,
                'displayData' => $processedResults['displayData'],
                'totalData' => $processedResults['totalData'],
                'sentimentDistribution' => $result['prediction_metrics']['sentiment_distribution'] ?? null,
                'executionTime' => $result['prediction_metrics']['execution_time'] ?? ['NaiveBayes' => 0, 'KNN' => 0],
                'visualizations' => $processedResults['visualizations'],
                'analisa_id' => $analisa->id,
                'downloadUrl' => $this->generateResultsCsv(
                    $result['results'] ?? [],
                    $processedResults['hasGroundTruth'],
                    $processedResults['groundTruthKey']
                ),
                'hasGroundTruth' => $hasGroundTruth,
                'correctPredictions' => $result['metrics']['correct_predictions'] ?? null,
                'modelEvaluation' => $result['model_evaluation'] ?? null,
                'wordFrequency' => [
                    'NaiveBayes' => $result['visualizations']['word_analysis']['frequency_chart']['NaiveBayes'] ?? null,
                    'KNN' => $result['visualizations']['word_analysis']['frequency_chart']['KNN'] ?? null,
                    'raw_data' => $result['visualizations']['word_analysis']['frequency_data'] ?? null
                ],
                'confusionHeatmap' => $result['visualizations']['model_comparison'] ?? null,
                'debugData' => [
                    'api_has_ground_truth' => $result['metrics']['has_ground_truth'] ?? false,
                    'detected_ground_truth' => !is_null($groundTruthKey),
                    'first_item_ground_truth' => $result['results'][0]['ground_truth'] ?? null,
                    'first_item_label' => $result['results'][0]['label'] ?? null
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('CSV Processing Error: ' . $e->getMessage());
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    protected function detectGroundTruthColumn(string $filePath): ?string
    {
        $csvFile = fopen($filePath, 'r');
        $firstLine = fgetcsv($csvFile);
        fclose($csvFile);

        $possibleColumns = ['label', 'sentiment', 'sentimen', 'ground_truth', 'actual', 'true_label'];

        foreach ($firstLine as $column) {
            $normalizedColumn = strtolower(trim($column));
            if (in_array($normalizedColumn, $possibleColumns)) {
                return $column;
            }
        }
        return null;
    }

    protected function processApiResults(array $apiResult): array
    {
        $defaultResponse = [
            'data' => [],
            'displayData' => [],
            'totalData' => 0,
            'hasGroundTruth' => false,
            'groundTruthKey' => null,
            'visualizations' => [],
            'result' => [
                'status' => 'error',
                'stats' => [
                    'NaiveBayes' => ['Positif' => 0, 'Negatif' => 0],
                    'KNN' => ['Positif' => 0, 'Negatif' => 0]
                ]
            ]
        ];

        if (!isset($apiResult['status']) || $apiResult['status'] !== 'success') {
            return $defaultResponse;
        }

        try {
            $results = $apiResult['results'] ?? [];
            $totalData = count($results);
            $hasGroundTruth = false;
            $groundTruthKey = null;

            // Cek semua kemungkinan format ground truth
            $groundTruthFormats = [
                'ground_truth.label' => fn($row) => $row['ground_truth']['label'] ?? null,
                'ground_truth' => fn($row) => is_array($row['ground_truth']) ? null : $row['ground_truth'],
                'label' => fn($row) => $row['label'] ?? null,
                'sentimen' => fn($row) => $row['sentimen'] ?? null,
                'sentiment' => fn($row) => $row['sentiment'] ?? null
            ];

            // Coba deteksi format yang digunakan
            if (!empty($results)) {
                foreach ($groundTruthFormats as $format => $extractor) {
                    $sampleValue = $extractor($results[0]);
                    if ($sampleValue !== null) {
                        $hasGroundTruth = true;
                        $groundTruthKey = $format;
                        Log::debug("Detected ground truth format: {$format}");
                        break;
                    }
                }
            }

            $processedData = [];
            foreach ($results as $row) {
                $trueLabel = null;
                $trueEmoji = null;

                if ($hasGroundTruth) {

                    $extractor = $groundTruthFormats[$groundTruthKey] ?? null;
                    $trueLabel = $extractor ? $extractor($row) : null;

                    if ($trueLabel !== null) {
                        $trueEmoji = $this->getEmoji($trueLabel);
                        Log::debug("Processed ground truth:", [
                            'label' => $trueLabel,
                            'emoji' => $trueEmoji,
                            'format' => $groundTruthKey
                        ]);
                    }
                }

                $processedData[] = [
                    'username' => $row['username'] ?? '',
                    'text' => $row['text'] ?? '',
                    'cleaned_text' => $row['cleaned_text'] ?? '',
                    'nb_prediction' => $row['predictions']['NaiveBayes']['prediction'] ?? '',
                    'knn_prediction' => $row['predictions']['KNN']['prediction'] ?? '',
                    'nb_emoji' => $row['predictions']['NaiveBayes']['emoji'] ?? '',
                    'knn_emoji' => $row['predictions']['KNN']['emoji'] ?? '',
                    'nb_confidence' => $row['predictions']['NaiveBayes']['confidence'] ?? null,
                    'knn_confidence' => $row['predictions']['KNN']['confidence'] ?? null,
                    'true_label' => $trueLabel,
                    'true_emoji' => $trueEmoji
                ];
            }

            // dd($processedData);
            return [
                'data' => $processedData,
                'displayData' => array_slice($processedData, 0, 10),
                'totalData' => $totalData,
                'hasGroundTruth' => $hasGroundTruth,
                'groundTruthKey' => $groundTruthKey,
                'visualizations' => [
                    'pie_chart' => $apiResult['visualizations']['sentiment_charts']['pie_chart'] ?? null,
                    'distribution_chart' => $apiResult['visualizations']['sentiment_charts']['distribution_chart'] ?? null,
                    'wordcloud_original' => $apiResult['visualizations']['wordclouds']['original'] ?? null,
                    'wordcloud_cleaned' => $apiResult['visualizations']['wordclouds']['cleaned'] ?? null,
                    'confusion_heatmap' => $hasGroundTruth ? ($apiResult['model_evaluation']['confusion_matrix'] ?? null) : null,
                    'word_frequency' => $apiResult['visualizations']['word_analysis'] ?? null
                ],
                'result' => [
                    'status' => $apiResult['status'],
                    'stats' => $apiResult['metrics']['sentiment_distribution'] ?? $defaultResponse['result']['stats']
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Error processing API results: ' . $e->getMessage());
            return $defaultResponse;
        }
    }

    protected function saveTextAnalysis(array $textLines, array $result): AnalisaData
    {
        $analisa = AnalisaData::create([
            'tipe_fitur' => 'text',
            'nama_file' => 'input_text',
            'waktu_analisis' => now()
        ]);

        foreach ($result['results'] as $index => $item) {
            DetailSentimen::create([
                'analisa_id' => $analisa->id,
                'text_asli' => $textLines[$index] ?? '',
                'text_bersih' => $item['cleaned_text'] ?? '',
                'nb_prediksi' => $item['predictions']['NaiveBayes']['prediction'] ?? null,
                'knn_prediksi' => $item['predictions']['KNN']['prediction'] ?? null,
                'nb_confidence' => $item['predictions']['NaiveBayes']['confidence'] ?? null,
                'knn_confidence' => $item['predictions']['KNN']['confidence'] ?? null,
                // 'true_label' => $trueLabel
            ]);
        }

        if (isset($result['metrics']['accuracy'])) {
            HasilAkurasi::simpanHasil(
                $analisa->id,
                [
                    'akurasi' => $result['metrics']['accuracy']['NaiveBayes'] ?? null,
                    'confusion_matrix' => isset($result['metrics']['confusion_matrix']['NaiveBayes'])
                        ? json_encode($result['metrics']['confusion_matrix']['NaiveBayes']) : null,
                    'waktu_eksekusi' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0
                ],
                [
                    'akurasi' => $result['metrics']['accuracy']['KNN'] ?? null,
                    'confusion_matrix' => isset($result['metrics']['confusion_matrix']['KNN'])
                        ? json_encode($result['metrics']['confusion_matrix']['KNN']) : null,
                    'waktu_eksekusi' => $result['metrics']['execution_time']['KNN'] ?? 0
                ]
            );
        }

        return $analisa;
    }

    protected function saveFileAnalysis($file, array $result, bool $hasGroundTruth): AnalisaData
    {
        $analisa = AnalisaData::create([
            'tipe_fitur' => 'file',
            'nama_file' => $file->getClientOriginalName(),
            'waktu_analisis' => now(),
            'has_ground_truth' => $hasGroundTruth
        ]);

        foreach ($result['results'] as $item) {

            $trueLabel = null;
            if ($hasGroundTruth) {
                if (isset($item['ground_truth']['label'])) {
                    $trueLabel = $item['ground_truth']['label'];
                } elseif (isset($item['label'])) {
                    $trueLabel = $item['label'];
                } elseif (isset($item['sentimen'])) {
                    $trueLabel = $item['sentimen'];
                }
            }

            DetailSentimen::create([
                'analisa_id' => $analisa->id,
                'username' => $item['username'] ?? 'unknown',
                'text_asli' => $item['text'] ?? '',
                'text_bersih' => $item['cleaned_text'] ?? '',
                'nb_prediksi' => $item['predictions']['NaiveBayes']['prediction'] ?? null,
                'knn_prediksi' => $item['predictions']['KNN']['prediction'] ?? null,
                'nb_confidence' => $item['predictions']['NaiveBayes']['confidence'] ?? null,
                'knn_confidence' => $item['predictions']['KNN']['confidence'] ?? null,
                'true_label' => $hasGroundTruth ? ($item['label'] ?? $item['sentimen'] ?? null) : null,
                'true_label' => $trueLabel
            ]);
        }

        if ($hasGroundTruth && isset($result['model_evaluation'])) {
            HasilAkurasi::simpanHasil(
                $analisa->id,
                [
                    'akurasi' => $result['model_evaluation']['performance']['NaiveBayes']['accuracy'] ?? null,
                    'confusion_matrix' => $result['model_evaluation']['confusion_matrix'] ?? null,
                    'waktu_eksekusi' => $result['prediction_metrics']['execution_time']['NaiveBayes'] ?? 0
                ],
                [
                    'akurasi' => $result['model_evaluation']['performance']['KNN']['accuracy'] ?? null,
                    'confusion_matrix' => $result['model_evaluation']['confusion_matrix'] ?? null,
                    'waktu_eksekusi' => $result['prediction_metrics']['execution_time']['KNN'] ?? 0
                ]
            );
        }

        return $analisa;
    }

    public function generateResultsCsv(array $data, bool $hasGroundTruth, ?string $groundTruthKey): string
    {
        if (empty($data)) {
            throw new \Exception('Data kosong, tidak dapat membuat CSV');
        }

        $headers = ['Username', 'Original Text', 'Cleaned Text'];
        if ($hasGroundTruth) {
            $headers[] = 'Label Manual';
        }
        $headers = array_merge($headers, [
            'NaiveBayes Prediction',
            'NaiveBayes Confidence',
            'KNN Prediction',
            'KNN Confidence'
        ]);
        if ($hasGroundTruth) {
            $headers[] = 'NB Match';
            $headers[] = 'KNN Match';
        }

        $csvContent = implode(',', $headers) . "\n";

        foreach ($data as $row) {
            $rowData = [
                $row['username'] ?? '',
                $row['text'] ?? '',
                $row['cleaned_text'] ?? ''
            ];

            if ($hasGroundTruth) {
                $rowData[] = $row[$groundTruthKey] ?? '';
            }

            $nbConfidence = isset($row['predictions']['NaiveBayes']['confidence'])
                ? number_format($row['predictions']['NaiveBayes']['confidence'] * 100, 2) . '%'
                : '0%';

            $knnConfidence = isset($row['predictions']['KNN']['confidence'])
                ? number_format($row['predictions']['KNN']['confidence'] * 100, 2) . '%'
                : '0%';

            $rowData = array_merge($rowData, [
                $row['predictions']['NaiveBayes']['prediction'] ?? '',
                $nbConfidence,
                $row['predictions']['KNN']['prediction'] ?? '',
                $knnConfidence
            ]);

            if ($hasGroundTruth) {
                $trueLabel = $row[$groundTruthKey] ?? null;
                $nbMatch = ($trueLabel && isset($row['predictions']['NaiveBayes']['prediction']))
                    ? ($row['predictions']['NaiveBayes']['prediction'] === $trueLabel ? '✔' : '✖')
                    : '';
                $knnMatch = ($trueLabel && isset($row['predictions']['KNN']['prediction']))
                    ? ($row['predictions']['KNN']['prediction'] === $trueLabel ? '✔' : '✖')
                    : '';

                $rowData[] = $nbMatch;
                $rowData[] = $knnMatch;
            }

            $escapedRow = array_map(function ($value) {
                return '"' . str_replace('"', '""', $value) . '"';
            }, $rowData);

            $csvContent .= implode(',', $escapedRow) . "\n";
        }

        $filename = 'hasil_analisis_' . now()->format('Ymd_His') . '.csv';
        Storage::disk('public')->put($filename, $csvContent);

        return asset('storage/' . $filename);
    }

    // Tambahkan method helper untuk emoji
    protected function getEmoji($label)
    {
        $label = strtolower($label);
        return strpos($label, 'positif') !== false ? '😊' : (strpos($label, 'negatif') !== false ? '😡' : '😐');
    }
}
