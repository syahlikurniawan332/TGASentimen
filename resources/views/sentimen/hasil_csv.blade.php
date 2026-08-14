@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 shadow-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold">Hasil Analisis Sentimen</h1>
                    <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 space-y-2 sm:space-y-0">
                        <div class="flex items-center text-sm text-slate-300">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ now()->format('d M Y H:i') }}
                        </div>
                        <div class="flex items-center text-sm text-slate-300">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                            </svg>
                            {{ $totalData }} data dianalisis
                        </div>
                        <div class="flex items-center text-sm text-slate-300">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            ID: {{ $analisa_id }}
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ $downloadUrl }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
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
            <div class="bg-white/5 backdrop-blur-xs rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <!-- ... -->
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-300 truncate">Naive Bayes</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold">
                                        {{ number_format($executionTime['NaiveBayes'] ?? 0, 2) }} ms
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="bg-green-900/20 p-3 rounded-lg border border-green-400/20">
                            <p class="text-sm font-medium text-green-400">Positif</p>
                            <p class="text-xl font-bold text-green-300">
                                {{ $sentimentDistribution['NaiveBayes']['Positif'] ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-red-900/20 p-3 rounded-lg border border-red-400/20">
                            <p class="text-sm font-medium text-red-400">Negatif</p>
                            <p class="text-xl font-bold text-red-300">
                                {{ $sentimentDistribution['NaiveBayes']['Negatif'] ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KNN Card -->
            <div class="bg-white/5 backdrop-blur-xs rounded-xl border border-white/10 hover:border-purple-400/30 transition-all">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500/10 rounded-md p-3">
                            <svg class="h-6 w-6 text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-300 truncate">KNN</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold">
                                        {{ number_format($executionTime['KNN'] ?? 0, 2) }} ms
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="bg-green-900/20 p-3 rounded-lg border border-green-400/20">
                            <p class="text-sm font-medium text-green-400">Positif</p>
                            <p class="text-xl font-bold text-green-300">{{ $sentimentDistribution['KNN']['Positif'] ?? 0 }}</p>
                        </div>
                        <div class="bg-red-900/20 p-3 rounded-lg border border-red-400/20">
                            <p class="text-sm font-medium text-red-400">Negatif</p>
                            <p class="text-xl font-bold text-red-300">{{ $sentimentDistribution['KNN']['Negatif'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="bg-white/5 backdrop-blur-xs rounded-xl border border-white/10 hover:border-blue-400/30 transition-all">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500/10 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-300 truncate">Ringkasan</dt>
                                <dd>
                                    <div class="text-lg font-semibold">{{ $totalData }} Data</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-sm text-slate-400">Analisis selesai pada:</p>
                            <p class="text-sm font-medium">{{ now()->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualizations Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Visualisasi Data</h2>

            <!-- Pie Chart -->
            <div class="grid grid-cols-1 gap-6 mb-6">
                @if(isset($visualizations['pie_chart']))
                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                    <div class="px-4 py-5 sm:px-6 border-b border-white/10">
                        <h3 class="text-lg font-medium">Distribusi Sentimen</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['pie_chart'] }}"
                            alt="Pie Chart Sentimen"
                            class="max-w-full h-auto rounded-lg">
                    </div>
                </div>
                @endif
            </div>

            <!-- Wordclouds -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                @if(isset($visualizations['wordcloud_original']))
                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                    <div class="px-4 py-5 sm:px-6 border-b border-white/10">
                        <h3 class="text-lg font-medium">Word Cloud Teks Asli</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['wordcloud_original'] }}"
                            alt="Word Cloud Original"
                            class="max-w-full h-auto rounded-lg">
                    </div>
                </div>
                @endif

                @if(isset($visualizations['wordcloud_cleaned']))
                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                    <div class="px-4 py-5 sm:px-6 border-b border-white/10">
                        <h3 class="text-lg font-medium">Word Cloud Teks Bersih</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['wordcloud_cleaned'] }}"
                            alt="Word Cloud Cleaned"
                            class="max-w-full h-auto rounded-lg">
                    </div>
                </div>
                @endif
            </div>

            <!-- Word Frequency Section -->
            @if(isset($wordFrequency['raw_data']))
            <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 mb-8">
                <div class="px-6 py-5 border-b border-white/10">
                    <h3 class="text-lg font-medium">Frekuensi Kata</h3>
                </div>

                <div class="px-6 py-5 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Naive Bayes -->
                    <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                        <h4 class="text-lg font-medium mb-4 text-center">Naive Bayes</h4>

                        @if(isset($wordFrequency['NaiveBayes']) && Str::startsWith($wordFrequency['NaiveBayes'], 'iVBOR'))
                        <div class="flex justify-center mb-6">
                            <img src="data:image/png;base64,{{ $wordFrequency['NaiveBayes'] }}"
                                class="w-full h-auto border border-white/10 rounded-lg">
                        </div>
                        @endif

                        <!-- Top 10 Positive Words -->
                        <div class="mb-6">
                            <h5 class="font-medium text-green-400 mb-2">Top 10 Kata Positif</h5>
                            @if(isset($wordFrequency['raw_data']['NaiveBayes']['positif']) && count($wordFrequency['raw_data']['NaiveBayes']['positif']) > 0)
                            <div class="space-y-1">
                                @foreach(array_slice($wordFrequency['raw_data']['NaiveBayes']['positif'], 0, 10) as $word => $count)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $word }}</span>
                                    <span class="font-medium">{{ $count }}x</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-sm text-slate-400">Tidak ada data kata positif</p>
                            @endif
                        </div>

                        @php
                        $positiveWords = array_slice(array_keys($wordFrequency['raw_data']['NaiveBayes']['positif'] ?? []), 0, 10);
                        $filteredNegatives = array_filter(
                        $wordFrequency['raw_data']['NaiveBayes']['negatif'] ?? [],
                        fn($word) => !in_array($word, $positiveWords),
                        ARRAY_FILTER_USE_KEY
                        );
                        @endphp
                        <!-- Top 10 Negative Words -->
                        <div>
                            <h5 class="font-medium text-red-400 mb-2">Top 10 Kata Negatif</h5>
                            @if(isset($wordFrequency['raw_data']['NaiveBayes']['negatif']) && count($wordFrequency['raw_data']['NaiveBayes']['negatif']) > 0)
                            <div class="space-y-1">
                                @foreach(array_slice($filteredNegatives, 0, 10) as $word => $count)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $word }}</span>
                                    <span class="font-medium">{{ $count }}x</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-sm text-slate-400">Tidak ada data kata negatif</p>
                            @endif
                        </div>
                    </div>

                    <!-- KNN -->
                    <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                        <h4 class="text-lg font-medium mb-4 text-center">KNN</h4>

                        @if(isset($wordFrequency['KNN']) && Str::startsWith($wordFrequency['KNN'], 'iVBOR'))
                        <div class="flex justify-center mb-6">
                            <img src="data:image/png;base64,{{ $wordFrequency['KNN'] }}"
                                class="w-full h-auto border border-white/10 rounded-lg">
                        </div>
                        @endif

                        <!-- Top 10 Positive Words -->
                        @php
                        $positifKNN = array_slice($wordFrequency['raw_data']['KNN']['positif'] ?? [], 0, 10);
                        $positiveWordsKNN = array_keys($positifKNN);
                        @endphp

                        <div class="mb-6">
                            <h5 class="font-medium text-green-400 mb-2">Top 10 Kata Positif</h5>
                            @if(count($positifKNN) > 0)
                            <div class="space-y-1">
                                @foreach($positifKNN as $word => $count)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $word }}</span>
                                    <span class="font-medium">{{ $count }}x</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-sm text-slate-400">Tidak ada data kata positif</p>
                            @endif
                        </div>

                        <!-- Top 10 Negative Words -->
                        @php
                        $negatifKNN = $wordFrequency['raw_data']['KNN']['negatif'] ?? [];
                        $filteredNegativeKNN = array_filter(
                        $negatifKNN,
                        fn($word) => !in_array($word, $positiveWordsKNN),
                        ARRAY_FILTER_USE_KEY
                        );
                        @endphp

                        <div>
                            <h5 class="font-medium text-red-400 mb-2">Top 10 Kata Negatif</h5>
                            @if(count($filteredNegativeKNN) > 0)
                            <div class="space-y-1">
                                @foreach(array_slice($filteredNegativeKNN, 0, 10) as $word => $count)
                                <div class="flex justify-between text-sm">
                                    <span>{{ $word }}</span>
                                    <span class="font-medium">{{ $count }}x</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-sm text-slate-400">Tidak ada data kata negatif</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endif

            @if(isset($modelEvaluation) && !empty($modelEvaluation['performance']))
            <!-- Prediction Summary Section -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 mb-8">
                <div class="px-6 py-5 border-b border-white/10">
                    <h3 class="text-lg font-medium">Ringkasan Prediksi</h3>
                    <p class="mt-1 text-sm text-slate-400">Perbandingan dengan label manual</p>
                    <p class="mt-1 text-sm text-slate-400">
                        Total Data: {{ $modelEvaluation['total_samples'] ?? 0 }} |
                        Waktu Analisis: {{ now()->format('d M Y H:i') }}
                    </p>
                </div>

                <!-- Confusion Matrix -->
                @if(isset($visualizations['confusion_heatmap']))
                <div class="px-6 py-5 border-b border-white/10">
                    <h4 class="text-lg font-medium mb-4">Confusion Matrix</h4>
                    <div class="flex justify-center">
                        <img src="data:image/png;base64,{{ $visualizations['confusion_heatmap'] }}"
                            class="max-w-full h-auto rounded-lg">
                    </div>
                </div>
                @endif

                <div class="px-6 py-5 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Naive Bayes -->
                    <div class="bg-blue-900/20 p-6 rounded-lg border border-blue-400/20">
                        <h4 class="text-xl font-bold mb-4 text-blue-300">Naive Bayes</h4>

                        <!-- Correct Predictions -->
                        <div class="mb-6">
                            <p class="text-sm text-purple-400">Prediksi Benar</p>
                            <p class="text-3xl font-bold">
                                {{ $modelEvaluation['performance']['NaiveBayes']['correct'] ?? 0 }}/{{ $modelEvaluation['total_samples'] ?? 0 }}
                            Total data</p>
                            <p class="text-lg">
                                ({{ $modelEvaluation['performance']['NaiveBayes']['correct'] && $modelEvaluation['total_samples'] ? 
            round(($modelEvaluation['performance']['NaiveBayes']['correct'] / $modelEvaluation['total_samples']) * 100, 2) : 0 }}%)
                            </p>
                        </div>

                        <!-- Performance Metrics -->
                        <div>
                            <p class="text-sm text-blue-400 mb-3">Metrik Performa</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-blue-300">Akurasi</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['NaiveBayes']['accuracy'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-blue-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-blue-300">Presisi</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['NaiveBayes']['precision'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-blue-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-blue-300">Recall</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['NaiveBayes']['recall'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-blue-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-blue-300">F1-Score</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['NaiveBayes']['f1_score'] * 100, 2) }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KNN -->
                    <div class="bg-purple-900/20 p-6 rounded-lg border border-purple-400/20">
                        <h4 class="text-xl font-bold mb-4 text-purple-300">KNN</h4>

                        <!-- Correct Predictions -->
                        <div class="mb-6">
                            <p class="text-sm text-purple-400">Prediksi Benar</p>
                            <p class="text-3xl font-bold">
                                {{ $modelEvaluation['performance']['KNN']['correct'] ?? 0 }}/{{ $modelEvaluation['total_samples'] ?? 0 }}
                            Total data</p>
                            <p class="text-lg">
                                ({{ $modelEvaluation['performance']['KNN']['correct'] && $modelEvaluation['total_samples'] ? 
            round(($modelEvaluation['performance']['KNN']['correct'] / $modelEvaluation['total_samples']) * 100, 2) : 0 }}%)
                            </p>
                        </div>

                        <!-- Performance Metrics -->
                        <div>
                            <p class="text-sm text-purple-400 mb-3">Metrik Performa</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-purple-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-purple-300">Akurasi</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['KNN']['accuracy'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-purple-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-purple-300">Presisi</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['KNN']['precision'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-purple-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-purple-300">Recall</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['KNN']['recall'] * 100, 2) }}%
                                    </p>
                                </div>
                                <div class="bg-purple-900/10 p-3 rounded-lg">
                                    <p class="text-xs text-purple-300">F1-Score</p>
                                    <p class="text-xl font-bold">
                                        {{ number_format($modelEvaluation['performance']['KNN']['f1_score'] * 100, 2) }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Results Table -->
            <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 mb-8">
                <!-- ... bagian header tetap sama ... -->

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-white/5">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Username</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Teks</th>
                                @if($hasGroundTruth)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Label Aktual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status NB</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status KNN</th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Naive Bayes</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">KNN</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-white/10">
                            @foreach($displayData as $index => $item)
                            <tr class="hover:bg-white/10">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item['username'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm max-w-xs truncate" title="{{ $item['text'] }}">
                                    {{ Str::limit($item['text'], 100) }}
                                </td>

                                @if($hasGroundTruth)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(isset($item['true_label']))
                                    <span class="px-2 py-1 text-xs rounded-full 
                {{ strtolower($item['true_label']) === 'positif' ? 'bg-green-900/20 text-green-400' : 'bg-red-900/20 text-red-400' }}">
                                        {{ $item['true_label'] }}
                                        @if(isset($item['true_emoji']))
                                        {{ $item['true_emoji'] }}
                                        @endif
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                    $nbCorrect = isset($item['true_label']) && isset($item['nb_prediction']) &&
                                    strtolower($item['nb_prediction']) === strtolower($item['true_label']);
                                    @endphp
                                    <span class="{{ $nbCorrect ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $nbCorrect ? '✔' : '✖' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                    $knnCorrect = isset($item['true_label']) && isset($item['knn_prediction']) &&
                                    strtolower($item['knn_prediction']) === strtolower($item['true_label']);
                                    @endphp
                                    <span class="{{ $knnCorrect ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $knnCorrect ? '✔' : '✖' }}
                                    </span>
                                </td>
                                @endif

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-xl mr-2">{{ $item['nb_emoji'] ?? '' }}</span>
                                        <div>
                                            <div class="text-sm capitalize">{{ $item['nb_prediction'] ?? '' }}</div>
                                            <div class="text-xs text-slate-400">
                                                {{ isset($item['nb_confidence']) ? round($item['nb_confidence'] * 100, 1) : 0 }}%
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-xl mr-2">{{ $item['knn_emoji'] ?? '' }}</span>
                                        <div>
                                            <div class="text-sm capitalize">{{ $item['knn_prediction'] ?? '' }}</div>
                                            <div class="text-xs text-slate-400">
                                                {{ isset($item['knn_confidence']) ? round($item['knn_confidence'] * 100, 1) : 0 }}%
                                            </div>
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
            <div class="flex justify-between no-print">
                <a href="{{ route('uploadCsvForm') }}" class="inline-flex items-center px-4 py-2 border border-white/20 text-sm font-medium rounded-lg text-white bg-white/5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
                <button onclick="window.print()" class="print-button no-print inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                    </svg>
                    Cetak Hasil
                </button>
            </div>
        </div>
</section>


<style>
    @media print {

        /* Reset & Base Styles */
        body {
            background: white !important;
            color: black !important;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 10mm;
        }

        /* Sembunyikan elemen yang tidak perlu dicetak */
        .no-print,
        .print-button,
        .download-button,
        nav,
        footer {
            display: none !important;
        }

        /* Layout Container */
        .max-w-7xl {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Header Section */
        .bg-white\\/5 {
            background: white !important;
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }

        /* Stats Cards */
        .grid-cols-1,
        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 10px !important;
            margin-bottom: 15px !important;
        }

        /* Visualizations */
        .lg\\:grid-cols-2 {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        /* Images/Charts */
        img {
            max-width: 100% !important;
            height: auto !important;
            border: 1px solid #eee !important;
            page-break-inside: avoid;
        }

        /* Tables */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 10pt !important;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
            background: white !important;
            color: black !important;
        }

        /* Text Colors */
        .text-slate-300,
        .text-slate-400,
        .text-white {
            color: black !important;
        }

        /* Backgrounds */
        .bg-white\\/5,
        .backdrop-blur-sm,
        .backdrop-blur-xs {
            background: white !important;
            backdrop-filter: none !important;
            border: 1px solid #ddd !important;
        }

        /* Borders */
        .border-white\\/10 {
            border-color: #ddd !important;
        }

        /* Padding Adjustments */
        .p-6,
        .px-6,
        .py-5,
        .px-4,
        .py-4 {
            padding: 10px !important;
        }

        /* Margin Adjustments */
        .mb-8 {
            margin-bottom: 15px !important;
        }

        /* Page Breaks */
        .page-break {
            page-break-after: always;
        }

        /* Force full width */
        .w-full {
            width: 100% !important;
        }

        /* Hide decorative elements */
        svg {
            display: none !important;
        }

        /* Print-specific footer */
        .print-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10pt;
            border-top: 1px solid #ddd;
            padding: 5px 0;
        }

        @page {
            size: A4;
            margin: 15mm;

            @bottom-right {
                content: "Halaman " counter(page);
                font-size: 10pt;
            }

            @top-center {
                content: "Laporan Analisis Sentimen";
                font-size: 12pt;
            }
        }
    }
</style>

@endsection