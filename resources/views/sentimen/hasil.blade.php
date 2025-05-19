@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Hasil Analisis Sentimen</h1>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">ID: {{ $analisa_id }}</span>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Teks -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Teks</p>
                    <p class="text-2xl font-bold">{{ count($textLines) }}</p>
                </div>
                <div class="text-blue-500">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4h6v2H9V4zm0 4h6v2H9V8zm0 4h6v2H9v-2zM5 4h2v2H5V4zm0 4h2v2H5V8zm0 4h2v2H5v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Waktu Eksekusi Naive Bayes -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Waktu NB</p>
                    <p class="text-2xl font-bold">{{ number_format($metrics['execution_time']['NaiveBayes'] ?? 0, 2) }} ms</p>
                </div>
                <div class="text-green-500">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Waktu Eksekusi KNN -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Waktu KNN</p>
                    <p class="text-2xl font-bold">{{ number_format($metrics['execution_time']['KNN'] ?? 0, 2) }} ms</p>
                </div>
                <div class="text-purple-500">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Visualisasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Pie Chart -->
        @if(isset($visualizations['pie_chart']))
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Distribusi Sentimen</h2>
            <div class="flex justify-center">
                <img src="data:image/png;base64,{{ $visualizations['pie_chart'] }}" alt="Pie Chart Sentimen" class="max-w-full h-auto">
            </div>
        </div>
        @endif

        <!-- Word Cloud Original -->
        @if(isset($visualizations['wordcloud_original']))
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Word Cloud Teks Asli</h2>
            <div class="flex justify-center">
                <img src="data:image/png;base64,{{ $visualizations['wordcloud_original'] }}" alt="Word Cloud Original" class="max-w-full h-auto">
            </div>
        </div>
        @endif
    </div>

    <!-- Word Frequency -->
    @if(isset($visualizations['word_frequency']))
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Frekuensi Kata</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-medium text-center mb-2">Naive Bayes</h3>
                <img src="data:image/png;base64,{{ $visualizations['word_frequency']['NaiveBayes'] }}" alt="Word Frequency NB" class="max-w-full h-auto">
            </div>
            <div>
                <h3 class="font-medium text-center mb-2">KNN</h3>
                <img src="data:image/png;base64,{{ $visualizations['word_frequency']['KNN'] }}" alt="Word Frequency KNN" class="max-w-full h-auto">
            </div>
        </div>
    </div>
    @endif

    <!-- Hasil Analisis -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold">Detail Analisis</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naive Bayes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KNN</th>
                    </tr>
                </thead>
                <!-- Di bagian tabel hasil, ganti $predictions dengan $result['results'] -->
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($result['results'] as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item['text'] }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="inline-block w-6 text-center">{{ $item['predictions']['NaiveBayes']['emoji'] }}</span>
                                <span class="ml-2 capitalize">{{ $item['predictions']['NaiveBayes']['prediction'] }}</span>
                                <span class="ml-2 text-xs text-gray-500">{{ round($item['predictions']['NaiveBayes']['confidence'] * 100, 1) }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="inline-block w-6 text-center">{{ $item['predictions']['KNN']['emoji'] }}</span>
                                <span class="ml-2 capitalize">{{ $item['predictions']['KNN']['prediction'] }}</span>
                                <span class="ml-2 text-xs text-gray-500">{{ round($item['predictions']['KNN']['confidence'] * 100, 1) }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('form') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Kembali
        </a>
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Cetak Hasil
        </button>
    </div>
</div>

@endsection