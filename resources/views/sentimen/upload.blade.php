@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Upload CSV Analisis Sentimen</h1>
      <p class="text-gray-600">Upload file CSV untuk analisis sentimen batch</p>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
      <div class="p-6 border-b border-gray-200 bg-blue-600">
        <h2 class="text-lg font-medium text-white">Upload File CSV</h2>
      </div>

      <div class="p-6">
        @if (session('error'))
        <div class="mb-4 p-4 rounded-md bg-red-50 border-l-4 border-red-500">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="ml-3">
              <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
          </div>
        </div>
        @endif

        <form method="POST" action="{{ route('processCsv') }}" enctype="multipart/form-data" class="space-y-6" id="upload-form">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Pilih File CSV
            </label>

            <!-- Drag and drop area -->
            <div id="drop-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition-colors hover:border-blue-500">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="csv_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                    <span>Upload file</span>
                    <input id="csv_file" name="csv_file" type="file" class="sr-only" accept=".csv" required>
                  </label>
                  <p class="pl-1">atau drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">
                  CSV dengan kolom username dan text (Maks. 2MB)
                </p>
              </div>
            </div>

            <!-- File preview -->
            <div id="file-preview" class="mt-4 hidden">
              <div class="flex items-center">
                <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div class="ml-2">
                  <p id="file-name" class="text-sm font-medium text-gray-900"></p>
                  <p id="file-size" class="text-xs text-gray-500"></p>
                </div>
              </div>
            </div>
          </div>

          <!-- CSV preview table -->
          <div id="csv-preview" class="hidden">
            <h3 class="text-sm font-medium text-gray-900 mb-3">Preview Data (5 baris pertama)</h3>
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">USERNAME</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TEXT</th>
                  </tr>
                </thead>
                <tbody id="preview-table-body" class="bg-white divide-y divide-gray-200"></tbody>
              </table>
            </div>
          </div>

          <div class="flex justify-between pt-4">
            <a href="{{ route('form') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
              Kembali
            </a>
            <button type="submit" id="submit-btn" disabled class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
              <span id="submit-text">Proses Analisis</span>
              <span id="loading-spinner" class="hidden ml-2">
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('csv_file');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const csvPreview = document.getElementById('csv-preview');
    const previewTableBody = document.getElementById('preview-table-body');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    const loadingSpinner = document.getElementById('loading-spinner');
    const uploadForm = document.getElementById('upload-form');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, preventDefaults, false);
      document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
      dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
      dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);

    // Handle selected files
    fileInput.addEventListener('change', handleFiles);

    // Form submission handler
    uploadForm.addEventListener('submit', function() {
      submitText.textContent = 'Memproses...';
      loadingSpinner.classList.remove('hidden');
      submitBtn.disabled = true;
    });

    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }

    function highlight() {
      dropArea.classList.add('border-blue-500', 'bg-blue-50');
    }

    function unhighlight() {
      dropArea.classList.remove('border-blue-500', 'bg-blue-50');
    }

    function handleDrop(e) {
      const dt = e.dataTransfer;
      const files = dt.files;
      fileInput.files = files;
      handleFiles({
        target: fileInput
      });
    }

    function handleFiles(e) {
      const files = e.target.files;
      if (files.length) {
        const file = files[0];

        // Show file info
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        filePreview.classList.remove('hidden');

        // Enable submit button
        submitBtn.disabled = false;

        // Preview CSV
        previewCSV(file);
      }
    }

    function formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function previewCSV(file) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const contents = e.target.result;
        const allLines = contents.split('\n');
        const headerLine = allLines[0];
        const dataLines = allLines.slice(1, 6); // Get up to 5 data rows
        
        // Parse header to find column indices
        const headers = parseCSVLine(headerLine);
        const usernameIndex = headers.findIndex(h => h.trim().toLowerCase() === 'username');
        const textIndex = headers.findIndex(h => h.trim().toLowerCase() === 'text');

        // Clear previous preview
        previewTableBody.innerHTML = '';

        // Only show preview if we have the required columns
        if (usernameIndex !== -1 && textIndex !== -1) {
          // Process data rows
          for (let i = 0; i < dataLines.length; i++) {
            if (!dataLines[i]) continue;

            const values = parseCSVLine(dataLines[i]);
            if (values.length <= Math.max(usernameIndex, textIndex)) continue;

            const row = document.createElement('tr');

            // Username column
            const usernameCell = document.createElement('td');
            usernameCell.className = 'px-4 py-3 whitespace-nowrap text-sm text-gray-900';
            usernameCell.textContent = values[usernameIndex].trim();
            row.appendChild(usernameCell);

            // Text column
            const textCell = document.createElement('td');
            textCell.className = 'px-4 py-3 text-sm text-gray-900';
            textCell.textContent = values[textIndex].trim();
            row.appendChild(textCell);

            previewTableBody.appendChild(row);
          }

          // Show preview
          csvPreview.classList.remove('hidden');
        } else {
          alert('File CSV harus memiliki kolom "username" dan "text"');
          filePreview.classList.add('hidden');
          submitBtn.disabled = true;
        }
      };

      reader.onerror = function() {
        alert('Gagal membaca file');
      };

      reader.readAsText(file);
    }

    // Simple CSV line parser that handles quoted values
    function parseCSVLine(line) {
      const result = [];
      let current = '';
      let inQuotes = false;

      for (let i = 0; i < line.length; i++) {
        const char = line[i];

        if (char === '"') {
          if (inQuotes && line[i + 1] === '"') {
            // Escaped quote
            current += '"';
            i++;
          } else {
            inQuotes = !inQuotes;
          }
        } else if (char === ',' && !inQuotes) {
          result.push(current);
          current = '';
        } else {
          current += char;
        }
      }

      result.push(current);
      return result;
    }
  });
</script>
@endsection