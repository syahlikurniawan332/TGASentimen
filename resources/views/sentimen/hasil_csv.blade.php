@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900">Hasil Analisis Sentimen</h1>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ now()->format('d M Y H:i') }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                            </svg>
                            {{ $totalData }} data dianalisis
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            ID: {{ $analisa_id }}
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ $downloadUrl }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Download CSV
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
            <!-- Naive Bayes Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Naive Bayes</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ number_format($executionTime['NaiveBayes'] ?? 0, 2) }} ms
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-sm font-medium text-green-800">Positif</p>
                            <p class="text-xl font-bold text-green-600">{{ $sentimentDistribution['NaiveBayes']['Positif'] ?? 0 }}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <p class="text-sm font-medium text-red-800">Negatif</p>
                            <p class="text-xl font-bold text-red-600">{{ $sentimentDistribution['NaiveBayes']['Negatif'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KNN Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">KNN</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ number_format($executionTime['KNN'] ?? 0, 2) }} ms
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-sm font-medium text-green-800">Positif</p>
                            <p class="text-xl font-bold text-green-600">{{ $sentimentDistribution['KNN']['Positif'] ?? 0 }}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <p class="text-sm font-medium text-red-800">Negatif</p>
                            <p class="text-xl font-bold text-red-600">{{ $sentimentDistribution['KNN']['Negatif'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Ringkasan</dt>
                                <dd>
                                    <div class="text-lg font-semibold text-gray-900">{{ $totalData }} Data</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="border-t border-gray-200 pt-4">
                            <p class="text-sm text-gray-500">Analisis selesai pada:</p>
                            <p class="text-sm font-medium text-gray-900">{{ now()->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualizations Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Visualisasi Data</h2>

            <!-- First Row of Visualizations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                @if(isset($visualizations['pie_chart']))
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Distribusi Sentimen</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['pie_chart'] }}" alt="Pie Chart Sentimen" class="max-w-full h-auto">
                    </div>
                </div>
                @endif

                @if(isset($visualizations['confusion_heatmap']))
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Confusion Matrix</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['confusion_heatmap'] }}" alt="Confusion Matrix" class="max-w-full h-auto">
                    </div>
                </div>
                @endif
            </div>

            <!-- Second Row of Visualizations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @if(isset($visualizations['wordcloud_original']))
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Word Cloud Teks Asli</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['wordcloud_original'] }}" alt="Word Cloud Original" class="max-w-full h-auto">
                    </div>
                </div>
                @endif

                @if(isset($visualizations['wordcloud_cleaned']))
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Word Cloud Teks Bersih</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['wordcloud_cleaned'] }}" alt="Word Cloud Cleaned" class="max-w-full h-auto">
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Word Frequency Section -->
        @if(isset($wordFrequency))
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Frekuensi Kata</h3>
                <p class="mt-1 text-sm text-gray-500">Kata-kata yang paling sering muncul dalam analisis</p>
            </div>

            <div class="px-6 py-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Naive Bayes Word Frequency -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-medium text-gray-900 mb-4 text-center">
                            Distribusi Kata - Naive Bayes
                        </h4>
                        @if($wordFrequency['NaiveBayes'] && Str::startsWith($wordFrequency['NaiveBayes'], 'iVBOR'))
                        <div class="flex justify-center">
                            <img src="data:image/png;base64,{{ $wordFrequency['NaiveBayes'] }}"
                                alt="Word Frequency Naive Bayes"
                                class="w-full h-auto max-w-lg border border-gray-200 rounded">
                        </div>
                        @else
                        <div class="text-center py-8 bg-white rounded">
                            <p class="text-gray-500">Visualisasi frekuensi kata tidak tersedia</p>
                        </div>
                        @endif

                        <!-- Raw Data Table -->
                        @if(isset($wordFrequency['raw_data']['NaiveBayes']) && count($wordFrequency['raw_data']['NaiveBayes']) > 0)
                        <div class="mt-6">
                            <h5 class="font-medium text-gray-700 mb-2">Data Mentah (Top 10)</h5>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kata</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Frekuensi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach(array_slice($wordFrequency['raw_data']['NaiveBayes']['positif'], 0, 5) as $word => $count)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-green-600">{{ $word }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $count }}</td>
                                        </tr>
                                        @endforeach
                                        @foreach(array_slice($wordFrequency['raw_data']['NaiveBayes']['negatif'], 0, 5) as $word => $count)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-red-600">{{ $word }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $count }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- KNN Word Frequency -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-medium text-gray-900 mb-4 text-center">
                            Distribusi Kata - KNN
                        </h4>
                        @if($wordFrequency['KNN'] && Str::startsWith($wordFrequency['KNN'], 'iVBOR'))
                        <div class="flex justify-center">
                            <img src="data:image/png;base64,{{ $wordFrequency['KNN'] }}"
                                alt="Word Frequency KNN"
                                class="w-full h-auto max-w-lg border border-gray-200 rounded">
                        </div>
                        @else
                        <div class="text-center py-8 bg-white rounded">
                            <p class="text-gray-500">Visualisasi frekuensi kata tidak tersedia</p>
                        </div>
                        @endif

                        <!-- Raw Data Table -->
                        @if(isset($wordFrequency['raw_data']['KNN']) && count($wordFrequency['raw_data']['KNN']) > 0)
                        <div class="mt-6">
                            <h5 class="font-medium text-gray-700 mb-2">Data Mentah (Top 10)</h5>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kata</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Frekuensi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach(array_slice($wordFrequency['raw_data']['KNN']['positif'], 0, 5) as $word => $count)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-green-600">{{ $word }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $count }}</td>
                                        </tr>
                                        @endforeach
                                        @foreach(array_slice($wordFrequency['raw_data']['KNN']['negatif'], 0, 5) as $word => $count)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-red-600">{{ $word }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $count }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Results Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Analisis</h3>
                    <span class="text-sm text-gray-500">
                        Menampilkan {{ min(10, $totalData) }} dari {{ $totalData }} data
                    </span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teks</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naive Bayes</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KNN</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($displayData as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item['username'] ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $item['text'] }}">{{ Str::limit($item['text'], 100) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-xl mr-2">{{ $item['nb_emoji'] }}</span>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 capitalize">{{ $item['nb_prediction'] }}</div>
                                        <div class="text-xs text-gray-500">{{ round($item['nb_confidence'] * 100, 1) }}% confidence</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-xl mr-2">{{ $item['knn_emoji'] }}</span>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 capitalize">{{ $item['knn_prediction'] }}</div>
                                        <div class="text-xs text-gray-500">{{ round($item['knn_confidence'] * 100, 1) }}% confidence</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('uploadCsvForm') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                </svg>
                Cetak Hasil
            </button>
        </div>
    </div>
</div>
@endsection