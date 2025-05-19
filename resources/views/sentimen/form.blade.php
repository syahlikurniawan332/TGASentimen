@extends('layouts.app')

@section('content')
<!-- resources/views/components/hero-section.blade.php -->
<section class="relative bg-gradient-to-br from-gray-900 via-purple-900 to-gray-800 text-white py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
  <!-- Background pattern -->
  <div class="absolute inset-0 opacity-20">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiPjxwYXRoIGQ9Ik0gMCwwIEwgNDAsMCA0MCw0MCBaIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMTY1LDE4MCwyNTIsMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PHBhdGggZD0iTSAwLDAgTCAwLDQwIDQwLDQwIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMTY1LDE4MCwyNTIsMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIi8+PC9zdmc+')]"></div>
  </div>

  <!-- Floating elements -->
  <div class="absolute top-1/4 left-1/5 w-32 h-32 bg-blue-500/10 rounded-xl backdrop-blur-sm border border-blue-500/20 animate-float animation-delay-1000 flex items-center justify-center p-4">
    <div class="text-center">
      <div class="text-4xl font-bold text-blue-400 mb-2">NB</div>
      <div class="text-xs text-blue-300">Naive Bayes</div>
    </div>
  </div>

  <div class="absolute top-1/3 right-1/4 w-32 h-32 bg-purple-500/10 rounded-xl backdrop-blur-sm border border-purple-500/20 animate-float animation-delay-2000 flex items-center justify-center p-4">
    <div class="text-center">
      <div class="text-4xl font-bold text-purple-400 mb-2">KNN</div>
      <div class="text-xs text-purple-300">k-Nearest Neighbors</div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <!-- Text content -->
      <div class="lg:w-1/2">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 animate-fadeInUp">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Analisis Sentimen</span>
          <span class="block mt-3">Dengan Machine Learning</span>
        </h1>

        <p class="text-xl text-gray-300 mb-8 leading-relaxed animate-fadeInUp animation-delay-200">
          Sistem analisis sentimen berbasis dua model machine learning (Naive Bayes dan KNN) yang dibangun dengan teknologi modern.
        </p>

        <!-- Technology stack -->
        <div class="mb-8 bg-gray-800/50 rounded-xl p-6 border border-gray-700/50 backdrop-blur-sm animate-fadeInUp animation-delay-400">
          <h3 class="text-lg font-semibold mb-4 text-blue-400 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
            Dibangun Dengan
          </h3>
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-gray-700/30 p-4 rounded-lg border border-blue-500/20 flex items-center gap-3">
              <img src="{{ asset('img/laravel.png') }}" alt="Laravel" class="h-8">
              <div>
                <h4 class="font-medium">Laravel 10</h4>
                <p class="text-xs text-gray-400">PHP Framework</p>
              </div>
            </div>
            <div class="bg-gray-700/30 p-4 rounded-lg border border-purple-500/20 flex items-center gap-3">
              <img src="{{ asset('img/tailwindcss.png') }}" alt="Tailwind CSS" class="h-8">
              <div>
                <h4 class="font-medium">Tailwind CSS</h4>
                <p class="text-xs text-gray-400">CSS Framework</p>
              </div>
            </div>
            <div class="bg-gray-700/30 p-4 rounded-lg border border-green-500/20 flex items-center gap-3">
              <img src="{{ asset('img/python.png') }}" alt="Python" class="h-8">
              <div>
                <h4 class="font-medium">Python</h4>
                <p class="text-xs text-gray-400">Machine Learning</p>
              </div>
            </div>
            <div class="bg-gray-700/30 p-4 rounded-lg border border-yellow-500/20 flex items-center gap-3">
              <img src="{{ asset('img/flask.png') }}" alt="Flask" class="h-8">
              <div>
                <h4 class="font-medium">Flask API</h4>
                <p class="text-xs text-gray-400">Model Serving</p>
              </div>
            </div>
          </div>
        </div>

        <!-- CTA buttons -->
        <div class="flex flex-col sm:flex-row gap-4 animate-fadeInUp animation-delay-600">
          <a href="#demo" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
            </svg>
            Coba Demo
          </a>
          <a href="#methodology" class="border-2 border-gray-500 hover:border-white bg-transparent hover:bg-white/5 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
            Pelajari Metode
          </a>
        </div>
      </div>

      <!-- Model visualization -->
      <div class="lg:w-1/2 mt-12 lg:mt-0">
        <div class="relative bg-gray-800/50 rounded-2xl shadow-2xl overflow-hidden border border-gray-700/50 backdrop-blur-sm transform hover:scale-[1.01] transition duration-700 animate-fadeInRight">
          <!-- Model comparison -->
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-6 text-center text-white">Perbandingan Model</h3>
            <div class="h-64 flex items-end space-x-8">
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gradient-to-t from-blue-500 to-blue-600 rounded-t-lg animate-grow" style="height: 85%">
                  <div class="text-center -mt-6 text-xs font-bold text-blue-300">85%</div>
                </div>
                <div class="mt-2 text-xs text-blue-400">Naive Bayes</div>
                <div class="text-xs text-gray-400 mt-1">Probabilistik</div>
              </div>
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gradient-to-t from-purple-500 to-purple-600 rounded-t-lg animate-grow animation-delay-300" style="height: 82%">
                  <div class="text-center -mt-6 text-xs font-bold text-purple-300">82%</div>
                </div>
                <div class="mt-2 text-xs text-purple-400">K-NN</div>
                <div class="text-xs text-gray-400 mt-1">Instance-based</div>
              </div>
            </div>
          </div>

          <!-- Sample output -->
          <div class="border-t border-gray-700/50 p-6 bg-gray-900/30">
            <h4 class="text-sm font-semibold mb-3 text-gray-300">Contoh Hasil Analisis</h4>
            <div class="space-y-3">
              <div class="flex items-start gap-2">
                <div class="mt-1 w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
                <div>
                  <p class="text-sm">"Produk sangat bagus, saya suka!"</p>
                  <p class="text-xs text-blue-400 mt-1">Positif (0.89) - Naive Bayes</p>
                </div>
              </div>
              <div class="flex items-start gap-2">
                <div class="mt-1 w-2 h-2 rounded-full bg-purple-500 animate-pulse animation-delay-1000"></div>
                <div>
                  <p class="text-sm">"Pelayanan sangat buruk"</p>
                  <p class="text-xs text-purple-400 mt-1">Negatif (0.91) - KNN</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
  <div class="max-w-6xl mx-auto">
    <!-- Header Konten dengan Animasi -->
    <div class="text-center mb-12 transform transition-all duration-500 hover:scale-105">
      <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4 animate-fade-in-down">
        <span class="inline-block mr-2">🔍</span>Analisis Sentimen Canggih
      </h1>
      <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto animate-fade-in-up delay-100">
        Sistem kami menganalisis teks Anda menggunakan dua metode sekaligus:
        <span class="font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-300">
          <span class="inline-block mr-1">🧠</span>Naive Bayes
        </span> dan
        <span class="font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors duration-300">
          <span class="inline-block mr-1">📊</span>K-Nearest Neighbors
        </span>
      </p>
    </div>

    <!-- Card Input dengan Animasi -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden transition-all duration-300 hover:shadow-2xl mb-16 animate-fade-in-up delay-200">
      <!-- Header Card -->
      <div class="border-b border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
          <div class="flex items-center">
            <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-lg mr-4">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Input Analisis</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Masukkan teks untuk dianalisis dengan kedua algoritma
              </p>
            </div>
          </div>
          <div class="mt-4 sm:mt-0">
            <a href="{{ route('uploadCsvForm') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105 shadow-md">
              <svg class="-ml-1 mr-2 h-5 w-5 animate-bounce-x" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
              Upload CSV
            </a>
          </div>
        </div>
      </div>

      <!-- Form Input -->
      <div class="p-6 md:p-8">
        @if (session('error'))
        <div class="mb-6 p-4 rounded-md bg-red-50 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 animate-shake">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-500 dark:text-red-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="ml-3">
              <p class="text-sm text-red-700 dark:text-red-200">{{ session('error') }}</p>
            </div>
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('predictText') }}" class="space-y-6">
          @csrf

          <!-- Text Input Area -->
          <div>
            <div class="flex justify-between items-center mb-2">
              <label for="text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Masukkan Teks untuk Dianalisis
                <span class="ml-2" data-tippy-content="Anda bisa menganalisis beberapa teks sekaligus dengan memisahkan setiap teks dengan baris baru">
                  <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                  </svg>
                </span>
              </label>
              <span class="text-xs text-gray-500 dark:text-gray-400" id="charCount">0 karakter</span>
            </div>

            <textarea name="text" id="text" rows="8" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-300 hover:border-blue-400 focus:hover:border-blue-500 @error('text') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Masukkan teks atau beberapa teks (pisahkan dengan baris baru)" required>{{ old('text') }}</textarea>

            @error('text')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Info Box dengan Animasi -->
          <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg transform transition-all duration-300 hover:scale-[1.01]">
            <div class="flex">
              <div class="flex-shrink-0 animate-pulse">
                <svg class="h-5 w-5 text-blue-400 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                  Analisis Ganda
                </h3>
                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                  <p>
                    Sistem akan menjalankan analisis menggunakan:
                  </p>
                  <ul class="list-disc pl-5 mt-1 space-y-1">
                    <li class="transition-colors duration-300 hover:text-blue-800 dark:hover:text-blue-200"><span class="font-medium">Naive Bayes</span> untuk efisiensi</li>
                    <li class="transition-colors duration-300 hover:text-blue-800 dark:hover:text-blue-200"><span class="font-medium">K-Nearest Neighbors</span> untuk akurasi</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Example Box (hidden by default) -->
          <div id="exampleBox" class="hidden bg-blue-50 dark:bg-blue-900 p-4 rounded-lg animate-fade-in">
            <p class="text-sm text-blue-800 dark:text-blue-200 font-medium mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
              Contoh Teks untuk Analisis:
            </p>
            <p class="text-sm text-blue-700 dark:text-blue-300 mb-2">
              "Produk ini sangat bagus dan berkualitas tinggi, sangat memuaskan!"<br>
              "Saya kecewa dengan pelayanan yang diberikan, sangat tidak profesional."<br>
              "Pengiriman cukup cepat tapi kemasan produk kurang baik, perlu perbaikan."
            </p>
            <button type="button" id="useExample" class="text-xs text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 font-medium transition-colors duration-300 flex items-center">
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
              </svg>
              Gunakan contoh ini
            </button>
          </div>

          <!-- Submit Button dengan Animasi -->
          <div class="flex justify-between items-center pt-4">
            <button type="button" id="sampleBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              Lihat Contoh
            </button>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105 transform hover:-translate-y-1">
              <svg class="-ml-1 mr-3 h-5 w-5 animate-pulse" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
              </svg>
              Analisis dengan Kedua Metode
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Bagian Proses dan Metodologi dengan Animasi -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden p-6 transition-all duration-300 hover:shadow-2xl animate-fade-in-up delay-300">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        Proses Analisis Sentimen
      </h2>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg transform transition-all duration-300 hover:scale-105 hover:shadow-md">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center animate-bounce">
              1
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              Preprocessing Teks
            </h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Teks input akan melalui pembersihan, tokenisasi, penghapusan stopword, dan stemming untuk mempersiapkan data analisis.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg transform transition-all duration-300 hover:scale-105 hover:shadow-md">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-purple-500 text-white rounded-full w-8 h-8 flex items-center justify-center animate-bounce delay-100">
              2
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
              Klasifikasi Ganda
            </h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Sistem menjalankan analisis paralel dengan Naive Bayes dan KNN secara bersamaan untuk mendapatkan hasil komprehensif.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg transform transition-all duration-300 hover:scale-105 hover:shadow-md">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center animate-bounce delay-200">
              3
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Hasil Komparatif
            </h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Hasil dari kedua metode ditampilkan secara berdampingan dengan confidence score masing-masing.
          </p>
        </div>
      </div>

      <!-- Metodologi Section -->
      <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center">
          <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
          </svg>
          Metodologi yang Digunakan
        </h3>
        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-blue-50 dark:bg-blue-900/30 p-5 rounded-lg border border-blue-100 dark:border-blue-800 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
            <h4 class="font-medium text-blue-800 dark:text-blue-200 flex items-center">
              <svg class="w-5 h-5 mr-2 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Naive Bayes
            </h4>
            <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">
              Menggunakan pendekatan probabilistik yang efisien untuk klasifikasi teks dengan asumsi independensi antar fitur. Cocok untuk analisis cepat dengan dataset besar.
            </p>
          </div>
          <div class="bg-purple-50 dark:bg-purple-900/30 p-5 rounded-lg border border-purple-100 dark:border-purple-800 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
            <h4 class="font-medium text-purple-800 dark:text-purple-200 flex items-center">
              <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              K-Nearest Neighbors
            </h4>
            <p class="mt-2 text-sm text-purple-700 dark:text-purple-300">
              Berdasarkan pengukuran kemiripan dengan tetangga terdekat. Lebih adaptif dengan pola data kompleks dan memberikan hasil akurat ketika parameter optimal.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tambahkan animasi CSS -->
<style>
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeInRight {
    from {
      opacity: 0;
      transform: translateX(20px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes float {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-15px);
    }
  }

  @keyframes grow {
    from {
      height: 0;
    }

    to {
      height: 100%;
    }
  }

  @keyframes pulse {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: 0.5;
    }
  }

  .animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
  }

  .animate-fadeInRight {
    animation: fadeInRight 0.8s ease-out forwards;
  }

  .animate-float {
    animation: float 6s ease-in-out infinite;
  }

  .animate-grow {
    animation: grow 1s ease-out forwards;
    transform-origin: bottom;
  }

  .animate-pulse {
    animation: pulse 2s infinite;
  }

  .animation-delay-200 {
    animation-delay: 0.2s;
  }

  .animation-delay-300 {
    animation-delay: 0.3s;
  }

  .animation-delay-400 {
    animation-delay: 0.4s;
  }

  .animation-delay-600 {
    animation-delay: 0.6s;
  }

  .animation-delay-1000 {
    animation-delay: 1s;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes shake {

    0%,
    100% {
      transform: translateX(0);
    }

    10%,
    30%,
    50%,
    70%,
    90% {
      transform: translateX(-5px);
    }

    20%,
    40%,
    60%,
    80% {
      transform: translateX(5px);
    }
  }

  @keyframes bounceX {

    0%,
    100% {
      transform: translateX(0);
    }

    50% {
      transform: translateX(5px);
    }
  }

  @keyframes spinSlow {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  .animate-fade-in-down {
    animation: fadeInDown 0.6s ease-out;
  }

  .animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
  }

  .animate-shake {
    animation: shake 0.5s cubic-bezier(.36, .07, .19, .97) both;
  }

  .animate-bounce-x {
    animation: bounceX 1s infinite;
  }

  .animate-spin-slow {
    animation: spinSlow 8s linear infinite;
  }

  .delay-100 {
    animation-delay: 0.1s;
  }

  .delay-200 {
    animation-delay: 0.2s;
  }

  .delay-300 {
    animation-delay: 0.3s;
  }

  .hover\:scale-105:hover {
    transform: scale(1.05);
  }

  .hover\:-translate-y-1:hover {
    transform: translateY(-4px);
  }
</style>

@push('scripts')
<!-- JavaScript untuk fitur tambahan -->
<script>
  // Menghitung karakter
  document.getElementById('text').addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length + ' karakter';
  });

  // Contoh teks
  document.getElementById('sampleBtn').addEventListener('click', function() {
    const exampleBox = document.getElementById('exampleBox');
    exampleBox.classList.toggle('hidden');
  });

  document.getElementById('useExample').addEventListener('click', function() {
    document.getElementById('text').value = `"Produk ini sangat bagus dan berkualitas tinggi, sangat memuaskan!"\n"Saya kecewa dengan pelayanan yang diberikan, sangat tidak profesional."\n"Pengiriman cukup cepat tapi kemasan produk kurang baik, perlu perbaikan."`;
    document.getElementById('exampleBox').classList.add('hidden');
    document.getElementById('charCount').textContent = document.getElementById('text').value.length + ' karakter';
  });

  // Inisialisasi tooltip (jika menggunakan Tippy.js)
  if (typeof tippy !== 'undefined') {
    tippy('[data-tippy-content]', {
      placement: 'top',
      animation: 'shift-away',
      theme: 'light-border'
    });
  }
</script>
@endpush

@endsection