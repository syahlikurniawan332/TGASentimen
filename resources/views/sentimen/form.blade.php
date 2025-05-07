@extends('layouts.app')

@section('content')
<section class="relative bg-gradient-to-r from-blue-600 to-indigo-800 text-white py-20 px-4 sm:px-6 lg:px-8">
  <!-- Background pattern atau ilustrasi -->
  <div class="absolute inset-0 opacity-10">
    <img src="{{ asset('img/set2.jpg') }}" alt="Background pattern" class="w-full h-full object-cover">
  </div>

  <div class="max-w-7xl mx-auto relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <!-- Teks konten -->
      <div class="lg:w-1/2">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
          Analisis Sentimen dengan <span class="text-yellow-300">Machine Learning</span>
        </h1>

        <p class="text-lg md:text-xl text-blue-100 mb-8">
          Sistem canggih berbasis Naive Bayes dan KNN untuk mengklasifikasikan sentimen dari data teks secara akurat dan efisien.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a href="#demo" class="bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
            Coba Sekarang
          </a>
          <a href="#methodology" class="border-2 border-white hover:bg-white hover:text-blue-800 font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
            Pelajari Metodologi
          </a>
        </div>

        <!-- Teknologi yang digunakan -->
        <div class="flex items-center gap-4">
          <span class="text-blue-200">Dibangun dengan:</span>
          <div class="flex gap-3">
            <div class="tooltip" data-tip="Laravel">
              <img src="{{ asset('img/laravel.png') }}" alt="Laravel" class="h-8">
            </div>
            <div class="tooltip" data-tip="Tailwind CSS">
              <img src="{{ asset('img/tailwindcss.png') }}" alt="Tailwind CSS" class="h-8">
            </div>
            <div class="tooltip" data-tip="Flask API">
              <img src="{{ asset('img/flask.png') }}" alt="Flask" class="h-8">
            </div>
            <div class="tooltip" data-tip="Python">
              <img src="{{ asset('img/python.png') }}" alt="Python" class="h-8">
            </div>
          </div>
        </div>
      </div>

      <!-- Ilustrasi atau screenshot -->
      <div class="lg:w-1/2 mt-10 lg:mt-0 hidden lg:block">
        <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-500">
          <img src="{{ asset('img/set1.png') }}" alt="Preview Analisis Sentimen" class="w-full h-auto">
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>

          <!-- Badge algoritma -->
          <div class="absolute bottom-4 left-4 flex gap-2">
            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">Naive Bayes</span>
            <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">K-Nearest Neighbors</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
  <div class="max-w-6xl mx-auto">
    <!-- Header Konten -->
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Analisis Sentimen Canggih</h1>
      <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
        Sistem kami menganalisis teks Anda menggunakan dua metode sekaligus: <span class="font-semibold text-blue-600 dark:text-blue-400">Naive Bayes</span> dan <span class="font-semibold text-purple-600 dark:text-purple-400">K-Nearest Neighbors</span>
      </p>
    </div>

    <!-- Card Input -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden transition-colors duration-300 mb-16">
      <!-- Header Card -->
      <div class="border-b border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Input Analisis</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
              Masukkan teks untuk dianalisis dengan kedua algoritma
            </p>
          </div>
          <div class="mt-4 sm:mt-0">
            <a href="{{ route('uploadCsvForm') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
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
        <div class="mb-6 p-4 rounded-md bg-red-50 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700">
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
                Masukkan Teks untuk Dianalisis
                <span class="ml-2" data-tippy-content="Anda bisa menganalisis beberapa teks sekaligus dengan memisahkan setiap teks dengan baris baru">
                  <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                  </svg>
                </span>
              </label>
              <span class="text-xs text-gray-500 dark:text-gray-400" id="charCount">0 karakter</span>
            </div>

            <textarea name="text" id="text" rows="8" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition duration-150 ease-in-out @error('text') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Masukkan teks atau beberapa teks (pisahkan dengan baris baru)" required>{{ old('text') }}</textarea>

            @error('text')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Info Box -->
          <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
            <div class="flex">
              <div class="flex-shrink-0">
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
                    <li><span class="font-medium">Naive Bayes</span> untuk efisiensi</li>
                    <li><span class="font-medium">K-Nearest Neighbors</span> untuk akurasi</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Example Box (hidden by default) -->
          <div id="exampleBox" class="hidden bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
            <p class="text-sm text-blue-800 dark:text-blue-200 font-medium mb-2">Contoh Teks untuk Analisis:</p>
            <p class="text-sm text-blue-700 dark:text-blue-300 mb-2">
              "Produk ini sangat bagus dan berkualitas tinggi, sangat memuaskan!"<br>
              "Saya kecewa dengan pelayanan yang diberikan, sangat tidak profesional."<br>
              "Pengiriman cukup cepat tapi kemasan produk kurang baik, perlu perbaikan."
            </p>
            <button type="button" id="useExample" class="text-xs text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 font-medium">
              Gunakan contoh ini
            </button>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-between items-center pt-4">
            <button type="button" id="sampleBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              Lihat Contoh
            </button>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
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
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden p-6 transition-colors duration-300">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Proses Analisis Sentimen</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              1
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white">Preprocessing Teks</h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Teks input akan melalui pembersihan, tokenisasi, penghapusan stopword, dan stemming untuk mempersiapkan data analisis.
          </p>
        </div>
        
        <!-- Step 2 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-purple-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              2
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white">Klasifikasi Ganda</h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Sistem menjalankan analisis paralel dengan Naive Bayes dan KNN secara bersamaan untuk mendapatkan hasil komprehensif.
          </p>
        </div>
        
        <!-- Step 3 -->
        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
              3
            </div>
            <h3 class="ml-4 text-lg font-medium text-gray-900 dark:text-white">Hasil Komparatif</h3>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            Hasil dari kedua metode ditampilkan secara berdampingan dengan confidence score masing-masing.
          </p>
        </div>
      </div>
      
      <!-- Metodologi Section -->
      <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Metodologi yang Digunakan</h3>
        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-blue-50 dark:bg-blue-900/30 p-5 rounded-lg border border-blue-100 dark:border-blue-800">
            <h4 class="font-medium text-blue-800 dark:text-blue-200 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              Naive Bayes
            </h4>
            <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">
              Menggunakan pendekatan probabilistik yang efisien untuk klasifikasi teks dengan asumsi independensi antar fitur. Cocok untuk analisis cepat dengan dataset besar.
            </p>
          </div>
          <div class="bg-purple-50 dark:bg-purple-900/30 p-5 rounded-lg border border-purple-100 dark:border-purple-800">
            <h4 class="font-medium text-purple-800 dark:text-purple-200 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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