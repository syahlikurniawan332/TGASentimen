@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white py-12 flex items-center relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,rgba(255,255,255,0.02)_50%,transparent_75%)] bg-[length:60px_60px]"></div>

  <div class="container mx-auto px-6 lg:px-8 relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
      <!-- Left Content -->
      <div class="w-full lg:w-3/5 text-center lg:text-left space-y-6">
        <!-- Main Heading -->
        <div class="space-y-3">
          <h1 class="text-4xl lg:text-5xl xl:text-6xl font-black leading-tight">
            Analisis Sentimen
            <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
              Otomatis
            </span>
          </h1>
          <div class="w-20 h-1 bg-gradient-to-r from-cyan-400 to-blue-400 mx-auto lg:mx-0 rounded-full"></div>
        </div>

        <!-- Subtitle -->
        <p class="text-lg lg:text-xl xl:text-2xl text-slate-300 font-light leading-relaxed max-w-2xl">
          Analisis perasaan dari teks menggunakan algoritma
          <span class="text-cyan-400 font-medium">Naive Bayes</span> dan
          <span class="text-blue-400 font-medium">KNN</span> secara real-time.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start pt-2">
          <button onclick="document.getElementById('form-analisa').scrollIntoView({ behavior: 'smooth' })" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 text-sm">
            Mulai Analisis
          </button>
          <button class="border-2 border-slate-400 text-slate-300 hover:bg-white hover:text-slate-900 font-semibold px-6 py-3 rounded-lg hover:border-white transition-all duration-300 text-sm">
            Pelajari Metode
          </button>
        </div>

        <!-- Technology Stack -->
        <div class="hidden lg:block bg-white/5 backdrop-blur-xl rounded-xl p-6 border border-white/10 shadow-lg mt-8">
          <h3 class="text-md font-bold text-white mb-4 text-center tracking-wide">
            Teknologi yang Digunakan
          </h3>
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex flex-col items-center group">
              <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-2 group-hover:bg-white/20 transition-colors">
                <img src="{{ asset('img/python.png') }}" alt="Flask" class="w-6 h-auto" />
              </div>
              <span class="text-xs font-medium text-slate-300">Flask</span>
            </div>
            <div class="flex flex-col items-center group">
              <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-2 group-hover:bg-white/20 transition-colors">
                <img src="{{ asset('img/flask.png') }}" alt="Flask" class="w-6 h-auto" />
              </div>
              <span class="text-xs font-medium text-slate-300">Flask</span>
            </div>
            <div class="flex flex-col items-center group">
              <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-2 group-hover:bg-white/20 transition-colors">
                <img src="{{ asset('img/tailwindcss.png') }}" alt="Flask" class="w-6 h-auto" />
              </div>
              <span class="text-xs font-medium text-slate-300">Flask</span>
            </div>
            <div class="flex flex-col items-center group">
              <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-2 group-hover:bg-white/20 transition-colors">
                <img src="{{ asset('img/laravel.png') }}" alt="Flask" class="w-6 h-auto" />
              </div>
              <span class="text-xs font-medium text-slate-300">Flask</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Image -->
      <div class="hidden lg:block lg:w-3/5 flex justify-center">
        <div class="relative p-1 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-xl shadow-lg">
          <div class="bg-slate-800 rounded-lg p-3 border border-slate-700">
            <img
              src="{{ asset('img/set2.jpg') }}"
              alt="Ilustrasi Analisis Sentimen"
              class="w-full h-auto rounded-md" />
            <p class="text-center text-xs text-slate-300 mt-1">
              Visualisasi hasil analisis sentimen
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white py-12 px-4 sm:px-6 lg:px-8">
  <div id="form-analisa" class="max-w-6xl mx-auto">
    <!-- Header Konten -->
    <div class="text-center mb-10">
      <h1 class="text-3xl lg:text-4xl font-black text-white mb-4">
        <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
          🔍 Analisis Sentimen Canggih
        </span>
      </h1>
      <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-blue-400 mx-auto rounded-full mb-6"></div>
      <p class="text-lg lg:text-xl text-slate-300 max-w-3xl mx-auto">
        Sistem kami menganalisis teks Anda menggunakan dua metode sekaligus:
        <span class="font-medium text-cyan-400">🧠 Naive Bayes</span> dan
        <span class="font-medium text-blue-400">📊 K-Nearest Neighbors</span>
      </p>
    </div>

    <!-- Card Input -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 shadow-lg overflow-hidden mb-12 transition-all duration-300 hover:border-cyan-400/30">
      <!-- Header Card -->
      <div class="border-b border-white/10 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
          <div class="flex items-center">
            <div class="bg-cyan-400/10 p-3 rounded-lg mr-4">
              <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-xl font-bold text-white">Input Analisis</h2>
              <p class="text-sm text-slate-400 mt-1">
                Masukkan teks untuk dianalisis dengan kedua algoritma
              </p>
            </div>
          </div>
          <div class="mt-4 sm:mt-0">
            <a href="{{ route('uploadCsvForm') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none shadow-md transition-all duration-300">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
        <div class="mb-6 p-4 rounded-lg bg-red-900/50 border-l-4 border-red-400">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="ml-3">
              <p class="text-sm text-red-200">{{ session('error') }}</p>
            </div>
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('predictText') }}" class="space-y-6">
          @csrf

          <!-- Text Input Area -->
          <div>
            <div class="flex justify-between items-center mb-2">
              <label for="text" class="block text-sm font-medium text-slate-300 flex items-center">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Masukkan Teks untuk Dianalisis
              </label>
              <span class="text-xs text-slate-400" id="charCount">0 karakter</span>
            </div>

            <textarea name="text" id="text" rows="6" class="block w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-white placeholder-slate-400 transition-all duration-300 @error('text') border-red-400 text-red-200 placeholder-red-300 @enderror" placeholder="Masukkan teks atau beberapa teks (pisahkan dengan baris baru)" required>{{ old('text') }}</textarea>

            @error('text')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Info Box -->
          <div class="bg-cyan-900/30 p-4 rounded-lg border border-cyan-400/20">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-cyan-200">
                  Analisis Ganda
                </h3>
                <div class="mt-2 text-sm text-cyan-300">
                  <p>
                    Sistem akan menjalankan analisis menggunakan:
                  </p>
                  <ul class="list-disc pl-5 mt-1 space-y-1">
                    <li><span class="font-medium">Naive Bayes</span> untuk efisiensi</li>
                    <li><span class="font-medium">K-Nearest Neighbors</span> untuk akurasi</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Example Box (hidden by default) -->
          <div id="exampleBox" class="hidden bg-blue-900/30 p-4 rounded-lg border border-blue-400/20">
            <p class="text-sm text-blue-200 font-medium mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
              Contoh Teks untuk Analisis:
            </p>
            <p class="text-sm text-blue-300 mb-2">
              "Produk ini sangat bagus dan berkualitas tinggi, sangat memuaskan!"<br>
              "Saya kecewa dengan pelayanan yang diberikan, sangat tidak profesional."<br>
              "Pengiriman cukup cepat tapi kemasan produk kurang baik, perlu perbaikan."
            </p>
            <button type="button" id="useExample" class="text-xs text-blue-400 hover:text-blue-300 font-medium transition-colors duration-300 flex items-center">
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
              </svg>
              Gunakan contoh ini
            </button>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-between items-center pt-4">
            <button type="button" id="sampleBtn" class="inline-flex items-center px-4 py-2 border border-white/20 text-sm font-medium rounded-lg text-slate-200 bg-white/5 hover:bg-white/10 focus:outline-none transition-all duration-300">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              Lihat Contoh
            </button>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-md text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none transition-all duration-300 transform hover:-translate-y-0.5">
              <svg class="-ml-1 mr-3 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
              </svg>
              Analisis dengan Kedua Metode
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Bagian Proses dan Metodologi -->
    <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 shadow-lg overflow-hidden p-6 transition-all duration-300 hover:border-cyan-400/30">
      <h2 class="text-xl lg:text-2xl font-bold text-white mb-8 flex items-center">
        <svg class="w-6 h-6 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        Proses Analisis Sentimen
      </h2>

      <div class="grid md:grid-cols-3 gap-6">
        <!-- Step 1 -->
        <div class="bg-white/5 backdrop-blur-xs p-6 rounded-lg border border-white/10 hover:border-cyan-400/30 transition-all duration-300">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-cyan-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              1
            </div>
            <h3 class="ml-4 text-lg font-medium text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              Preprocessing Teks
            </h3>
          </div>
          <p class="text-slate-300">
            Teks input akan melalui pembersihan, tokenisasi, penghapusan stopword, dan stemming untuk mempersiapkan data analisis.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="bg-white/5 backdrop-blur-xs p-6 rounded-lg border border-white/10 hover:border-blue-400/30 transition-all duration-300">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              2
            </div>
            <h3 class="ml-4 text-lg font-medium text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
              Klasifikasi Ganda
            </h3>
          </div>
          <p class="text-slate-300">
            Sistem menjalankan analisis paralel dengan Naive Bayes dan KNN secara bersamaan untuk mendapatkan hasil komprehensif.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="bg-white/5 backdrop-blur-xs p-6 rounded-lg border border-white/10 hover:border-green-400/30 transition-all duration-300">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              3
            </div>
            <h3 class="ml-4 text-lg font-medium text-white flex items-center">
              <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Hasil Komparatif
            </h3>
          </div>
          <p class="text-slate-300">
            Hasil dari kedua metode ditampilkan secara berdampingan dengan confidence score masing-masing.
          </p>
        </div>
      </div>

      <!-- Metodologi Section -->
      <div class="mt-10 pt-8 border-t border-white/10">
        <h3 class="text-lg font-medium text-white mb-6 flex items-center">
          <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
          </svg>
          Metodologi yang Digunakan
        </h3>

        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-cyan-900/20 p-5 rounded-lg border border-cyan-400/20 transition-all duration-300 hover:border-cyan-400/40">
            <h4 class="font-medium text-cyan-300 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Naive Bayes
            </h4>
            <p class="mt-2 text-sm text-cyan-200">
              Menggunakan pendekatan probabilistik yang efisien untuk klasifikasi teks dengan asumsi independensi antar fitur. Cocok untuk analisis cepat dengan dataset besar.
            </p>
          </div>

          <div class="bg-blue-900/20 p-5 rounded-lg border border-blue-400/20 transition-all duration-300 hover:border-blue-400/40">
            <h4 class="font-medium text-blue-300 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              K-Nearest Neighbors
            </h4>
            <p class="mt-2 text-sm text-blue-200">
              Berdasarkan pengukuran kemiripan dengan tetangga terdekat. Lebih adaptif dengan pola data kompleks dan memberikan hasil akurat ketika parameter optimal.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // === Hitung jumlah karakter ===
    const textarea = document.getElementById('text');
    const charCount = document.getElementById('charCount');

    if (textarea && charCount) {
      const updateCharCount = () => {
        charCount.textContent = `${textarea.value.length} karakter`;
      };

      textarea.addEventListener('input', updateCharCount);
      updateCharCount(); // Inisialisasi saat halaman dimuat
    }

    // === Tampilkan/Sembunyikan kotak contoh ===
    const sampleBtn = document.getElementById('sampleBtn');
    const exampleBox = document.getElementById('exampleBox');

    if (sampleBtn && exampleBox) {
      sampleBtn.addEventListener('click', () => {
        exampleBox.classList.toggle('hidden');
      });
    }

    // === Gunakan Contoh ===
    const useExampleBtn = document.getElementById('useExample');
    const exampleTextParagraph = document.querySelector('#exampleBox p.text-blue-300');

    if (useExampleBtn && exampleTextParagraph && textarea) {
      useExampleBtn.addEventListener('click', () => {
        const exampleText = exampleTextParagraph.innerText.trim();
        textarea.value = exampleText;
        textarea.dispatchEvent(new Event('input')); // Untuk trigger update karakter
      });
    }
  });
</script>
@endpush


@endsection