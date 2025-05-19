<?php

namespace App\Http\Controllers;

use App\Models\AnalisaData;
use App\Models\DetailSentimen;
use App\Models\HasilAkurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SentimentController extends Controller
{
    protected $apiUrl = 'http://localhost:5000/api/check-model';
    protected $uploadApiUrl = 'http://localhost:5000/api/upload-file';

    public function index()
    {
        return view('sentimen.form');
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

            // Simpan ke database sesuai kode asli
            $analisa = AnalisaData::create([
                'tipe_fitur' => 'text', // Diubah dari AnalisaData::TIPE_TEKS
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
                    'knn_confidence' => $item['predictions']['KNN']['confidence'] ?? null
                ]);
            }

            // Simpan hasil akurasi sesuai kode asli
            if (isset($result['metrics']['accuracy'])) {
                HasilAkurasi::simpanHasil(
                    $analisa->id,
                    [
                        'akurasi' => $result['metrics']['accuracy']['NaiveBayes'] ?? null,
                        'confusion_matrix' => isset($result['metrics']['confusion_matrix']['NaiveBayes']) ?
                            json_encode($result['metrics']['confusion_matrix']['NaiveBayes']) : null,
                        'waktu_eksekusi' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0
                    ],
                    [
                        'akurasi' => $result['metrics']['accuracy']['KNN'] ?? null,
                        'confusion_matrix' => isset($result['metrics']['confusion_matrix']['KNN']) ?
                            json_encode($result['metrics']['confusion_matrix']['KNN']) : null,
                        'waktu_eksekusi' => $result['metrics']['execution_time']['KNN'] ?? 0
                    ]
                );
            }

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
                'predictions' => $result['results'] // Tambahkan ini
            ]);
        } catch (\Exception $e) {
            Log::error('Error predicting text: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function uploadCsvForm()
    {
        return view('sentimen.upload');
    }

    public function processCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('csv_file');

            $response = Http::attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post($this->uploadApiUrl);

            if (!$response->successful()) {
                throw new \Exception('API Error: ' . $response->status() . ' - ' . $response->body());
            }

            $result = $response->json();

            if (!isset($result['status']) || $result['status'] !== 'success') {
                throw new \Exception('Invalid API response format');
            }

            // Simpan ke database sesuai kode asli
            $analisa = AnalisaData::create([
                'tipe_fitur' => 'file', // Diubah dari AnalisaData::TIPE_FILE
                'nama_file' => $file->getClientOriginalName(),
                'waktu_analisis' => now()
            ]);

            // Simpan detail sentimen
            foreach ($result['results'] as $item) {
                DetailSentimen::create([
                    'analisa_id' => $analisa->id,
                    'username' => $item['username'] ?? 'unknown',
                    'text_asli' => $item['text'],
                    'text_bersih' => $item['cleaned_text'],
                    'nb_prediksi' => $item['predictions']['NaiveBayes']['prediction'],
                    'knn_prediksi' => $item['predictions']['KNN']['prediction'],
                    'nb_confidence' => $item['predictions']['NaiveBayes']['confidence'] ?? null,
                    'knn_confidence' => $item['predictions']['KNN']['confidence'] ?? null
                ]);
            }

            // Simpan hasil akurasi sesuai kode asli
            if (isset($result['metrics']['accuracy'])) {
                HasilAkurasi::simpanHasil(
                    $analisa->id,
                    [
                        'akurasi' => $result['metrics']['accuracy']['NaiveBayes'] ?? null,
                        'confusion_matrix' => isset($result['metrics']['confusion_matrix']['NaiveBayes']) ?
                            json_encode($result['metrics']['confusion_matrix']['NaiveBayes']) : null,
                        'waktu_eksekusi' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0
                    ],
                    [
                        'akurasi' => $result['metrics']['accuracy']['KNN'] ?? null,
                        'confusion_matrix' => isset($result['metrics']['confusion_matrix']['KNN']) ?
                            json_encode($result['metrics']['confusion_matrix']['KNN']) : null,
                        'waktu_eksekusi' => $result['metrics']['execution_time']['KNN'] ?? 0
                    ]
                );
            }

            $processed = $this->processApiResults($result);
            $downloadUrl = $this->generateResultsCsv($result['results'] ?? []);

            // Tambahkan penanganan word frequency
            $wordFrequency = [
                'NaiveBayes' => $result['visualizations']['word_frequency']['NaiveBayes'] ?? null,
                'KNN' => $result['visualizations']['word_frequency']['KNN'] ?? null,
                'raw_data' => $result['visualizations']['word_frequency']['raw_data'] ?? null
            ];

            // Tambahkan penanganan classification reports
            $classificationReports = [
                'NaiveBayes' => $result['visualizations']['classification_reports']['NaiveBayes'] ?? null,
                'KNN' => $result['visualizations']['classification_reports']['KNN'] ?? null
            ];

            return view('sentimen.hasil_csv', [
                'result' => $result,
                'displayData' => $processed['displayData'],
                'totalData' => $processed['totalData'],
                'sentimentDistribution' => $result['metrics']['sentiment_distribution'] ?? null,
                'accuracy' => $result['metrics']['accuracy'] ?? null,
                'wordFrequency' => $wordFrequency,
                'pieChart' => $result['visualizations']['pie_chart'] ?? null,
                'analisa_id' => $analisa->id,
                'downloadUrl' => $downloadUrl,
                'visualizations' => $result['visualizations'] ?? [],
                'executionTime' => [
                    'NaiveBayes' => $result['metrics']['execution_time']['NaiveBayes'] ?? 0,
                    'KNN' => $result['metrics']['execution_time']['KNN'] ?? 0
                ],
                'classificationReports' => $classificationReports
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing CSV: ' . $e->getMessage());
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    protected function processApiResults(array $apiResult): array
    {
        $defaultResponse = [
            'data' => [],
            'displayData' => [],
            'totalData' => 0,
            'result' => [
                'status' => 'error',
                'stats' => [
                    'NaiveBayes' => ['Positif' => 0, 'Negatif' => 0],
                    'KNN' => ['Positif' => 0, 'Negatif' => 0]
                ],
                'accuracy' => null,
                'confusion_matrix' => null,
                'pie_chart' => null
            ]
        ];

        if (!isset($apiResult['status']) || $apiResult['status'] !== 'success') {
            return $defaultResponse;
        }

        try {
            $results = $apiResult['results'] ?? [];
            $totalData = count($results);

            $processedData = [];
            foreach ($results as $row) {
                $processedData[] = [
                    'username' => $row['username'] ?? '',
                    'text' => $row['text'] ?? '',
                    'cleaned_text' => $row['cleaned_text'] ?? '',
                    'nb_prediction' => $row['predictions']['NaiveBayes']['prediction'] ?? '',
                    'knn_prediction' => $row['predictions']['KNN']['prediction'] ?? '',
                    'nb_emoji' => $row['predictions']['NaiveBayes']['emoji'] ?? '',
                    'knn_emoji' => $row['predictions']['KNN']['emoji'] ?? '',
                    'nb_confidence' => $row['predictions']['NaiveBayes']['confidence'] ?? null,
                    'knn_confidence' => $row['predictions']['KNN']['confidence'] ?? null
                ];
            }

            return [
                'data' => $processedData,
                'displayData' => array_slice($processedData, 0, 10),
                'totalData' => $totalData,
                'result' => [
                    'status' => $apiResult['status'],
                    'stats' => $apiResult['metrics']['sentiment_distribution'] ?? $defaultResponse['result']['stats'],
                    'accuracy' => $apiResult['metrics']['accuracy'] ?? null,
                    'confusion_matrix' => $apiResult['metrics']['confusion_matrix'] ?? null,
                    'pie_chart' => $apiResult['visualizations']['pie_chart'] ?? null
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Error processing API results: ' . $e->getMessage());
            return $defaultResponse;
        }
    }

    public function generateResultsCsv(array $data): string
    {
        $headers = [
            'Username',
            'Original Text',
            'Cleaned Text',
            'NaiveBayes Prediction',
            'NaiveBayes Confidence',
            'NaiveBayes Emoji',
            'KNN Prediction',
            'KNN Confidence',
            'KNN Emoji'
        ];

        $csvContent = implode(',', $headers) . "\n";

        foreach ($data as $row) {
            $csvContent .= sprintf(
                '"%s","%s","%s","%s",%.2f,"%s","%s",%.2f,"%s"' . "\n",
                str_replace('"', '""', $row['username'] ?? ''),
                str_replace('"', '""', $row['text'] ?? ''),
                str_replace('"', '""', $row['cleaned_text'] ?? ''),
                $row['predictions']['NaiveBayes']['prediction'] ?? '',
                $row['predictions']['NaiveBayes']['confidence'] ?? 0,
                $row['predictions']['NaiveBayes']['emoji'] ?? '',
                $row['predictions']['KNN']['prediction'] ?? '',
                $row['predictions']['KNN']['confidence'] ?? 0,
                $row['predictions']['KNN']['emoji'] ?? ''
            );
        }

        $filename = 'hasil_analisis_' . now()->format('Ymd_His') . '.csv';
        Storage::disk('public')->put($filename, $csvContent);

        return asset('storage/' . $filename);
    }
}
