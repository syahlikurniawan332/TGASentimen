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
    protected $apiUrl = 'https://syahlikurniawan2.pythonanywhere.com/api/check-model';
    // protected $apiUrl = 'http://localhost:5000/api/check-model';
    // protected $uploadApiUrl = 'http://localhost:5000/api/upload-file';
    protected $uploadApiUrl = 'https://syahlikurniawan2.pythonanywhere.com/api/upload-file';
    protected $groundTruthColumns = ['label', 'sentiment', 'sentimen', 'ground_truth', 'actual', 'true_label'];

    // Basic Views
    public function index()
    {
        return view('sentimen.form');
    }
    public function uploadCsvForm()
    {
        return view('sentimen.upload');
    }

    // Main Processing Functions
    public function predictText(Request $request)
    {
        $request->validate(['text' => 'required|string']);

        try {
            $textLines = array_filter(
                preg_split('/\r\n|\r|\n/', $request->text),
                fn($line) => trim($line) !== ''
            ) ?: [trim($request->text)];

            $response = Http::post($this->apiUrl, ['texts' => $textLines]);
            if (!$response->successful()) throw new \Exception('API Error: ' . $response->status());

            $result = $response->json();
            $analisa = $this->saveAnalysis('text', 'input_text', $textLines, $result);

            return view('sentimen.hasil', array_merge(
                $this->prepareTextResults($textLines, $result),
                ['analisa_id' => $analisa->id]
            ));
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
            $groundTruthKey = $this->detectGroundTruth($file->getRealPath());
            $hasGroundTruth = !is_null($groundTruthKey);

            $response = Http::attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post($this->uploadApiUrl);

            if (!$response->successful()) throw new \Exception('API Error: ' . $response->status());

            $result = $response->json();
            $analisa = $this->saveAnalysis('file', $file->getClientOriginalName(), $result['results'], $result, $hasGroundTruth);

            return view('sentimen.hasil_csv', array_merge(
                $this->prepareCsvResults($result, $hasGroundTruth, $groundTruthKey),
                ['analisa_id' => $analisa->id]
            ));
        } catch (\Exception $e) {
            Log::error('CSV Processing Error: ' . $e->getMessage());
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    // Helper Functions
    protected function detectGroundTruth(string $filePath): ?string
    {
        $csvFile = fopen($filePath, 'r');
        $firstLine = fgetcsv($csvFile);
        fclose($csvFile);

        foreach ($firstLine as $column) {
            if (in_array(strtolower(trim($column)), $this->groundTruthColumns)) {
                return $column;
            }
        }
        return null;
    }

    protected function saveAnalysis(string $type, string $filename, array $data, array $result, bool $hasGroundTruth = false): AnalisaData
    {
        $analisa = AnalisaData::create([
            'tipe_fitur' => $type,
            'nama_file' => $filename,
            'waktu_analisis' => now(),
            'has_ground_truth' => $hasGroundTruth
        ]);

        foreach ($data as $index => $item) {
            $trueLabel = $hasGroundTruth
                ? ($item['ground_truth']['label'] ?? $item['label'] ?? $item['sentimen'] ?? null)
                : null;

            DetailSentimen::create([
                'analisa_id' => $analisa->id,
                'username' => $item['username'] ?? 'unknown',
                'text_asli' => $type === 'text' ? ($data[$index] ?? '') : ($item['text'] ?? ''),
                'text_bersih' => $item['cleaned_text'] ?? '',
                'nb_prediksi' => $item['predictions']['NaiveBayes']['prediction'] ?? null,
                'knn_prediksi' => $item['predictions']['KNN']['prediction'] ?? null,
                'nb_confidence' => $item['predictions']['NaiveBayes']['confidence'] ?? null,
                'knn_confidence' => $item['predictions']['KNN']['confidence'] ?? null,
                'true_label' => $trueLabel
            ]);
        }

        if (($hasGroundTruth || isset($result['metrics']['accuracy'])) && isset($result['model_evaluation'])) {
            HasilAkurasi::simpanHasil(
                $analisa->id,
                $this->prepareAccuracyData('NaiveBayes', $result),
                $this->prepareAccuracyData('KNN', $result)
            );
        }

        return $analisa;
    }

    protected function prepareAccuracyData(string $model, array $result): array
    {
        return [
            'akurasi' => $result['model_evaluation']['performance'][$model]['accuracy']
                ?? $result['metrics']['accuracy'][$model]
                ?? null,
            'confusion_matrix' => $result['model_evaluation']['confusion_matrix']
                ?? json_encode($result['metrics']['confusion_matrix'][$model] ?? null),
            'waktu_eksekusi' => $result['prediction_metrics']['execution_time'][$model]
                ?? $result['metrics']['execution_time'][$model]
                ?? 0
        ];
    }

    protected function prepareTextResults(array $textLines, array $result): array
    {
        // dd($result); 
        return [
            'result' => $result,
            'textLines' => $textLines,
            'chart_base64' => $result['visualizations']['pie_chart'] ?? null,
            'sentiment_distribution' => $result['metrics']['sentiment_distribution'] ?? null,
            'execution_time' => [
                'NaiveBayes' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0,
                'KNN' => $result['metrics']['execution_time']['KNN'] ?? 0
            ],
            'visualizations' => $result['visualizations'] ?? [],
            'predictions' => $result['results']
        ];
    }

    protected function prepareCsvResults(array $result, bool $hasGroundTruth, ?string $groundTruthKey): array
    {
        $processedData = array_map(function ($row) use ($hasGroundTruth, $groundTruthKey) {
            // Ambil label manual dari nested array 'ground_truth' atau kolom langsung
            $trueLabel = $hasGroundTruth
                ? ($row['ground_truth']['label'] ?? $row[$groundTruthKey] ?? null)
                : null;

            return [
                'username' => $row['username'] ?? '',
                'text' => $row['text'] ?? '',
                'cleaned_text' => $row['cleaned_text'] ?? '',
                'nb_prediction' => $row['predictions']['NaiveBayes']['prediction'] ?? '',
                'knn_prediction' => $row['predictions']['KNN']['prediction'] ?? '',
                'nb_emoji' => $row['predictions']['NaiveBayes']['emoji'] ?? $this->getEmoji($row['predictions']['NaiveBayes']['prediction'] ?? ''),
                'knn_emoji' => $row['predictions']['KNN']['emoji'] ?? $this->getEmoji($row['predictions']['KNN']['prediction'] ?? ''),
                'nb_confidence' => $row['predictions']['NaiveBayes']['confidence'] ?? null,
                'knn_confidence' => $row['predictions']['KNN']['confidence'] ?? null,
                'true_label' => $trueLabel,
                'true_emoji' => $trueLabel ? $this->getEmoji($trueLabel) : null,
            ];
        }, $result['results'] ?? []);

        // dd($result);
        // Hilangkan duplikasi kata yang muncul di kedua daftar
        $positiveWords = array_keys($result['visualizations']['word_analysis']['frequency_data']['NaiveBayes']['positif'] ?? []);
        $negativeWords = array_keys($result['visualizations']['word_analysis']['frequency_data']['NaiveBayes']['negatif'] ?? []);

        $uniqueNegativeWords = array_diff($negativeWords, $positiveWords);
        $filteredNegative = array_filter(
            $result['visualizations']['word_analysis']['frequency_data']['NaiveBayes']['negatif'] ?? [],
            fn($word) => in_array($word, $uniqueNegativeWords),
            ARRAY_FILTER_USE_KEY
        );
        return [
            'result' => $result,
            'displayData' => array_slice($processedData, 0, 10),
            'totalData' => count($processedData),
            'sentimentDistribution' => $result['prediction_metrics']['sentiment_distribution'] ?? null,
            'executionTime' => $result['prediction_metrics']['execution_time'] ?? ['NaiveBayes' => 0, 'KNN' => 0],
            'visualizations' => [
                'pie_chart' => $result['visualizations']['sentiment_charts']['pie_chart'] ?? null,
                'distribution_chart' => $result['visualizations']['sentiment_charts']['distribution_chart'] ?? null,
                'wordcloud_original' => $result['visualizations']['wordclouds']['original'] ?? null,
                'wordcloud_cleaned' => $result['visualizations']['wordclouds']['cleaned'] ?? null,
                'confusion_heatmap' => $hasGroundTruth ? ($result['model_evaluation']['confusion_matrix'] ?? null) : null,
                'word_frequency' => $result['visualizations']['word_analysis'] ?? null
            ],
            'downloadUrl' => $this->generateResultsCsv($result['results'] ?? [], $hasGroundTruth, $groundTruthKey),
            'hasGroundTruth' => $hasGroundTruth,
            'correctPredictions' => $result['metrics']['correct_predictions'] ?? null,
            'modelEvaluation' => $result['model_evaluation'] ?? null,
            'wordFrequency' => [ // Ditambahkan kembali
                'NaiveBayes' => $result['visualizations']['word_analysis']['frequency_chart']['NaiveBayes'] ?? null,
                'KNN' => $result['visualizations']['word_analysis']['frequency_chart']['KNN'] ?? null,
                'raw_data' => $result['visualizations']['word_analysis']['frequency_data'] ?? null
            ]
        ];
    }

    protected function generateResultsCsv(array $data, bool $hasGroundTruth, ?string $groundTruthKey): string
    {
        if (empty($data)) throw new \Exception('Data kosong, tidak dapat membuat CSV');

        $headers = ['Username', 'Original Text', 'Cleaned Text'];
        if ($hasGroundTruth) $headers[] = 'Label Manual';
        $headers = array_merge($headers, [
            'NaiveBayes Prediction',
            'NaiveBayes Confidence',
            'KNN Prediction',
            'KNN Confidence'
        ]);
        if ($hasGroundTruth) array_push($headers, 'NB Match', 'KNN Match');

        $csvContent = implode(',', $headers) . "\n";

        foreach ($data as $row) {
            $rowData = [
                $row['username'] ?? '',
                $row['text'] ?? '',
                $row['cleaned_text'] ?? ''
            ];

            if ($hasGroundTruth) $rowData[] = $row[$groundTruthKey] ?? '';

            $rowData = array_merge($rowData, [
                $row['predictions']['NaiveBayes']['prediction'] ?? '',
                number_format(($row['predictions']['NaiveBayes']['confidence'] ?? 0) * 100, 2) . '%',
                $row['predictions']['KNN']['prediction'] ?? '',
                number_format(($row['predictions']['KNN']['confidence'] ?? 0) * 100, 2) . '%'
            ]);

            if ($hasGroundTruth) {
                $trueLabel = $row[$groundTruthKey] ?? null;
                $rowData[] = $trueLabel && ($row['predictions']['NaiveBayes']['prediction'] ?? '') === $trueLabel ? '✔' : '✖';
                $rowData[] = $trueLabel && ($row['predictions']['KNN']['prediction'] ?? '') === $trueLabel ? '✔' : '✖';
            }

            $csvContent .= implode(',', array_map(
                fn($v) => '"' . str_replace('"', '""', $v) . '"',
                $rowData
            )) . "\n";
        }

        // dd($data);
        $filename = 'hasil_analisis_' . now()->format('Ymd_His') . '.csv';
        Storage::disk('public')->put($filename, $csvContent);
        return asset('storage/' . $filename);
    }

    protected function getEmoji($label)
    {
        return match (strtolower($label)) {
            str_contains(strtolower($label), 'positif') => '😊',
            str_contains(strtolower($label), 'negatif') => '😡',
            default => '😐'
        };
    }
}
