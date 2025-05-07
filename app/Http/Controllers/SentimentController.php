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

            // Kirim ke API Flask
            $response = Http::post($this->apiUrl, ['texts' => $textLines]);

            if (!$response->successful()) {
                throw new \Exception('API Error: ' . $response->status());
            }

            $result = $response->json();

            // Debug: Lihat struktur response
            // Log::debug('API Response:', $result);

            // Pastikan data dikirim ke view dengan format benar
            return view('sentimen.hasil', [
                'result' => $result,
                'textLines' => $textLines,
                'analisa_id' => rand(1000, 9999), // Contoh ID
                'chart_base64' => $result['pie_chart'] ?? null,
                'sentiment_distribution' => $result['sentiment_distribution'] ?? null
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

            // Simpan ke database
            $analisa = AnalisaData::create([
                'tipe_fitur' => AnalisaData::TIPE_FILE,
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
                    'nb_prediksi' => $item['NaiveBayes']['prediction'],
                    'knn_prediksi' => $item['KNN']['prediction']
                ]);
            }

            // Simpan hasil akurasi
            HasilAkurasi::simpanHasil(
                $analisa->id,
                [
                    'akurasi' => $result['accuracy']['NaiveBayes'],
                    'confusion_matrix' => $result['confusion_matrix'],
                    'waktu_eksekusi' => $result['execution_time_ms']['NaiveBayes']
                ],
                [
                    'akurasi' => $result['accuracy']['KNN'],
                    'confusion_matrix' => $result['confusion_matrix'],
                    'waktu_eksekusi' => $result['execution_time_ms']['KNN']
                ]
            );

            $processed = $this->processApiResults($result);
            $downloadUrl = $this->generateResultsCsv($result['results'] ?? []);

            return view('sentimen.hasil_csv', [
                'result' => $result,
                'displayData' => $processed['displayData'],
                'totalData' => $processed['totalData'],
                'sentimentDistribution' => $result['sentiment_distribution'],
                'accuracy' => $result['accuracy'],
                'pieChart' => $result['pie_chart'],
                'analisa_id' => $analisa->id,
                'downloadUrl' => $downloadUrl 
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing CSV: ' . $e->getMessage());
            return back()->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    /**
     * Save analysis results to database
     */
    protected function saveAnalysisResults(array $apiResult, array $textLines): AnalisaData
    {
        $analisa = AnalisaData::create([
            'tipe_fitur' => 'file',
            'nama_file' => 'book.csv',
            'waktu_analisis' => now()
        ]);

        // Simpan detail sentimen
        foreach ($apiResult['results'] as $result) {
            // Handle NaN values
            $text = is_numeric($result['text']) && is_nan($result['text']) ? '' : ($result['text'] ?? '');

            DetailSentimen::create([
                'analisa_id' => $analisa->id,
                'text_asli' => $text,
                'text_bersih' => $result['cleaned_text'] ?? '',
                'nb_prediksi' => $result['NaiveBayes']['prediction'] ?? null,
                'knn_prediksi' => $result['KNN']['prediction'] ?? null,
            ]);
        }

        // Simpan hasil akurasi
        if (isset($apiResult['accuracy'])) {
            HasilAkurasi::simpanHasil(
                $analisa->id,
                [
                    'akurasi' => $apiResult['accuracy']['NaiveBayes'] ?? 0,
                    'confusion_matrix' => json_encode($apiResult['confusion_matrix']['matrix'] ?? []),
                    'waktu_eksekusi' => $apiResult['execution_time_ms']['NaiveBayes'] ?? 0
                ],
                [
                    'akurasi' => $apiResult['accuracy']['KNN'] ?? 0,
                    'confusion_matrix' => json_encode($apiResult['confusion_matrix']['matrix'] ?? []),
                    'waktu_eksekusi' => $apiResult['execution_time_ms']['KNN'] ?? 0
                ]
            );
        }

        return $analisa;
    }

    /**
     * Process API results for CSV response
     */

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
                    'nb_prediction' => $row['NaiveBayes']['prediction'] ?? '',
                    'knn_prediction' => $row['KNN']['prediction'] ?? '',
                    'nb_emoji' => $row['NaiveBayes']['emoji'] ?? '',
                    'knn_emoji' => $row['KNN']['emoji'] ?? ''
                ];
            }

            return [
                'data' => $processedData,
                'displayData' => array_slice($processedData, 0, 10),
                'totalData' => $totalData,
                'result' => [
                    'status' => $apiResult['status'],
                    'stats' => $apiResult['sentiment_distribution'] ?? $defaultResponse['result']['stats'],
                    'accuracy' => $apiResult['accuracy'] ?? null,
                    'confusion_matrix' => $apiResult['confusion_matrix'] ?? null,
                    'pie_chart' => $apiResult['pie_chart'] ?? null
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Error processing API results: ' . $e->getMessage());
            return $defaultResponse;
        }
    }

    /**
     * Generate CSV file from results
     */
    // In SentimentController.php
    public function generateResultsCsv(array $data): string
    {
        $headers = [
            'Username',
            'Original Text',
            'Cleaned Text',
            'NaiveBayes Prediction',
            'NaiveBayes Emoji',
            'KNN Prediction',
            'KNN Emoji'
        ];

        $csvContent = implode(',', $headers) . "\n";

        foreach ($data as $row) {
            $csvContent .= sprintf(
                '"%s","%s","%s","%s","%s","%s","%s"' . "\n",
                str_replace('"', '""', $row['username'] ?? ''),
                str_replace('"', '""', $row['text'] ?? ''),
                str_replace('"', '""', $row['cleaned_text'] ?? ''),
                $row['NaiveBayes']['prediction'] ?? '',
                $row['NaiveBayes']['emoji'] ?? '',
                $row['KNN']['prediction'] ?? '',
                $row['KNN']['emoji'] ?? ''
            );
        }

        $filename = 'hasil_analisis_' . now()->format('Ymd_His') . '.csv';
        Storage::disk('public')->put($filename, $csvContent);

        return asset('storage/' . $filename);
    }
}
