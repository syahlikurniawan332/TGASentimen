@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Tentang Sistem Kami</h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Sistem analisis sentimen canggih yang dikembangkan sebagai bagian dari Tugas Akhir
            </p>
        </div>

        <!-- About Content -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden mb-16">
            <div class="p-8 md:p-12">
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Left Column -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Apa Itu Analisis Sentimen?</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Analisis sentimen adalah proses komputasi untuk mengidentifikasi dan mengkategorikan pendapat yang diekspresikan dalam suatu teks, terutama untuk menentukan apakah sikap penulis terhadap suatu topik bersifat positif, negatif, atau netral.
                        </p>
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-6 rounded-lg border border-blue-100 dark:border-blue-800">
                            <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-3">Mengapa Analisis Sentimen Penting?</h3>
                            <ul class="list-disc pl-5 space-y-2 text-blue-700 dark:text-blue-300">
                                <li>Memahami opini publik secara real-time</li>
                                <li>Mengukur kepuasan pelanggan</li>
                                <li>Memonitor reputasi brand</li>
                                <li>Mendukung pengambilan keputusan berbasis data</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column - System Overview -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Overview Sistem</h2>
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Kecepatan Tinggi</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">
                                        Sistem dapat memproses ratusan teks per detik berkat optimasi algoritma Naive Bayes.
                                    </p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Akurasi Tinggi</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">
                                        Kombinasi Naive Bayes dan KNN memberikan akurasi hingga 89% pada dataset uji.
                                    </p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Visualisasi Data</h3>
                                    <p class="mt-1 text-gray-600 dark:text-gray-300">
                                        Hasil analisis disajikan dalam bentuk visual yang mudah dipahami.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metodologi Section -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden mb-16">
            <div class="p-8 md:p-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Metodologi Penelitian</h2>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Naive Bayes -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg border border-blue-100 dark:border-blue-800">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 dark:bg-blue-800 p-3 rounded-full mr-4">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Naive Bayes</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Algoritma klasifikasi probabilistik yang mengasumsikan independensi antar fitur. Cocok untuk analisis teks karena kemampuannya menangani data dimensi tinggi.
                        </p>
                        <ul class="list-disc pl-5 space-y-1 text-gray-600 dark:text-gray-300">
                            <li>Kecepatan pelatihan tinggi</li>
                            <li>Performa baik dengan dataset besar</li>
                            <li>Implementasi sederhana</li>
                        </ul>
                    </div>

                    <!-- KNN -->
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg border border-purple-100 dark:border-purple-800">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-100 dark:bg-purple-800 p-3 rounded-full mr-4">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">K-Nearest Neighbors</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Algoritma berbasis instance yang mengklasifikasikan data baru berdasarkan kemiripan dengan tetangga terdekat dalam ruang fitur.
                        </p>
                        <ul class="list-disc pl-5 space-y-1 text-gray-600 dark:text-gray-300">
                            <li>Adaptif dengan pola data kompleks</li>
                            <li>Tidak membuat asumsi tentang distribusi data</li>
                            <li>Akurasi tinggi dengan parameter optimal</li>
                        </ul>
                    </div>
                </div>

                <!-- Workflow -->
                <div class="mt-12 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 text-center">Alur Kerja Sistem</h3>
                    <div class="flex flex-col items-center">
                        <div class="relative w-full max-w-4xl">
                            <!-- Step 1 -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center z-10">
                                    1
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Pengumpulan Data</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Dataset teks berlabel sentimen dikumpulkan dari berbagai sumber</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-gray-300 dark:border-gray-500 h-12 ml-5"></div>

                            <!-- Step 2 -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center z-10">
                                    2
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Preprocessing</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Case folding, tokenizing, stopword removal, dan stemming</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-gray-300 dark:border-gray-500 h-12 ml-5"></div>

                            <!-- Step 3 -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center z-10">
                                    3
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Pelatihan Model</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Naive Bayes dan KNN dilatih menggunakan dataset</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-gray-300 dark:border-gray-500 h-12 ml-5"></div>

                            <!-- Step 4 -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center z-10">
                                    4
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Analisis Teks</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Teks input diproses dan diklasifikasikan oleh kedua model</p>
                                </div>
                            </div>
                            <div class="border-l-2 border-gray-300 dark:border-gray-500 h-12 ml-5"></div>

                            <!-- Step 5 -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center z-10">
                                    5
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Visualisasi Hasil</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Hasil analisis ditampilkan dalam bentuk yang mudah dipahami</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Developer Section -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <div class="p-8 md:p-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Tentang Pengembang</h2>

                <div class="flex flex-col items-center">
                    <img class="h-32 w-32 rounded-full object-cover mb-6" src="{{ asset('img/set2.jpg') }}" alt="Developer Photo">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Syahli Kurniawan</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Mahasiswa Teknik Informatika - Politeknik Negeri Lhokseumawe</p>

                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="text-gray-400 hover:text-blue-500">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-red-500">
                            <span class="sr-only">Email</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z" />
                            </svg>
                        </a>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 text-center max-w-2xl">
                        Sistem ini dikembangkan sebagai bagian dari Tugas Akhir untuk memenuhi persyaratan kelulusan program studi Teknik Informatika di Universitas Anda.
                        Fokus penelitian adalah pada perbandingan performa algoritma Naive Bayes dan KNN untuk analisis sentimen dalam bahasa Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush

@endsection