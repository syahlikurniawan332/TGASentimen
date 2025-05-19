<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class TextHandleController extends Controller
{
    protected $flaskApiUrl = 'http://localhost:5000/';

    public function index()
    {
        $response = Http::get($this->flaskApiUrl);

        // Ambil isi JSON dari respons Flask
        $message = $response->json('message'); // Mengambil nilai "Hello, World!" dari {"message": "Hello, World!"}

        return view('sentimen.test', compact('message'));
    }

    public function process(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'texts' => 'required|string'
            ]);

            $rawTexts = $request->input('texts');
            $texts = array_filter(array_map('trim', explode("\n", $rawTexts)));

            if (empty($texts)) {
                throw new \Exception("Teks tidak boleh kosong");
            }

            $type = count($texts) === 1 ? 'single' : 'multi';

            // Format payload sesuai kebutuhan API Flask
            $payload = $type === 'single'
                ? ['text' => $texts[0]]
                : ['texts' => $texts];

            Log::debug('Payload ke Flask:', $payload);

            // Kirim ke Flask API
            $response = Http::timeout(30)
                ->retry(3, 100)
                ->post($this->flaskApiUrl . 'check-test', $payload);

            if (!$response->successful()) {
                throw new \Exception("API Flask merespon dengan status: " . $response->status());
            }

            $apiData = $response->json();
            Log::debug('Response dari Flask:', $apiData);

            // Normalisasi data
            $processedData = $this->processApiData($apiData, $type);

            return view('sentimen.result', array_merge(
                ['type' => $type],
                $processedData
            ));
        } catch (\Exception $e) {
            Log::error('Error proses: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Proses dan normalisasi data dari API Flask
     */
    protected function processApiData(array $apiData, string $type): array
    {
        try {
            // 1. Fungsi untuk memproses data gambar dengan aman
            $processImage = function ($img) {
                if (empty($img)) {
                    return null;
                }

                // Jika sudah dalam format yang benar
                if (is_string($img) && str_starts_with($img, 'data:image/png;base64,')) {
                    return $img;
                }

                // Jika format base64 salah (menggunakan : bukan ;)
                if (is_string($img) && str_contains($img, 'data:image/png:base64,')) {
                    return str_replace('data:image/png:base64,', 'data:image/png;base64,', $img);
                }

                // Jika hanya berisi base64 tanpa prefix
                if (is_string($img) && base64_decode($img, true)) {
                    return 'data:image/png;base64,' . $img;
                }

                // Jika berupa array, coba ekstrak data gambar
                if (is_array($img)) {
                    // Coba berbagai kemungkinan key
                    foreach (['data', 'image', 'content', 'base64'] as $key) {
                        if (!empty($img[$key]) && is_string($img[$key])) {
                            return $this->processImage($img[$key]);
                        }
                    }
                }

                return null;
            };

            // 2. Proses data prediksi
            $predictions = [];
            foreach ($apiData['results'] ?? [] as $item) {
                $predictions[] = [
                    'text' => $item['text'] ?? '',
                    'clean_text' => $item['clean_text'] ?? '',
                    'prediksi' => [
                        'knn' => [
                            'label' => $item['prediksi']['knn']['label'] ?? '-',
                            'emoji' => $this->getSentimentEmoji($item['prediksi']['knn']['label'] ?? ''),
                            'confidence' => $item['prediksi']['knn']['confidence'] ?? '0'
                        ],
                        'nb' => [
                            'label' => $item['prediksi']['nb']['label'] ?? '-',
                            'emoji' => $this->getSentimentEmoji($item['prediksi']['nb']['label'] ?? ''),
                            'confidence' => $item['prediksi']['nb']['confidence'] ?? '0'
                        ]
                    ],
                    'wordcloud_original' => $processImage($item['wordcloud_original'] ?? null)
                ];
            }

            // 3. Proses semua visualisasi
            $visualizations = [
                'wordcloud_clean' => $processImage($apiData['visualizations']['wordcloud_clean'] ?? null),
                'wordcloud_knn_sentiment' => $processImage($apiData['visualizations']['wordcloud_knn_sentiment'] ?? null),
                'wordcloud_nb_sentiment' => $processImage($apiData['visualizations']['wordcloud_nb_sentiment'] ?? null),
                'distribution_img' => $processImage($apiData['visualizations']['distribution_img'] ?? null),
                'word_frequency_img' => $processImage($apiData['visualizations']['word_frequency_img'] ?? null),
                'confusion_matrix' => $processImage($apiData['visualizations']['confusion_matrix'] ?? null),
                'classification_report' => $processImage($apiData['visualizations']['classification_report'] ?? null),
                'distribution_data' => $apiData['visualizations']['distribution_data'] ?? null
            ];

            // 4. Format output berdasarkan tipe (single/multi)
            if ($type === 'single' && !empty($predictions)) {
                return [
                    'type' => 'single',
                    'text' => $predictions[0]['text'],
                    'clean_text' => $predictions[0]['clean_text'],
                    'knn' => $predictions[0]['prediksi']['knn']['label'],
                    'nb' => $predictions[0]['prediksi']['nb']['label'],
                    'visualizations' => array_merge($visualizations, [
                        'wordcloud_original' => $predictions[0]['wordcloud_original']
                    ])
                ];
            }

            return [
                'type' => 'multi',
                'predictions' => $predictions,
                'visualizations' => $visualizations
            ];
        } catch (\Exception $e) {
            Log::error('Error processing API data: ' . $e->getMessage());
            return [
                'error' => 'Terjadi kesalahan dalam memproses data',
                'exception' => $e->getMessage()
            ];
        }
    }

    private function getSentimentEmoji($label): string
    {
        $label = strtolower(trim($label ?? ''));
        return match ($label) {
            'positif' => '😊',
            'negatif' => '😞',
            default => '😐'
        };
    }
}
