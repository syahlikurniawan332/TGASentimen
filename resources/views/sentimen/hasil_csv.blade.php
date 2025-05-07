<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis Sentimen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sentiment-cell {
            text-align: center;
        }
        .emoji {
            font-size: 1.5rem;
        }
        .chart-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .accuracy-badge {
            font-size: 0.9rem;
        }
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .positive {
            background-color: #d4edda;
            color: #155724;
        }
        .negative {
            background-color: #f8d7da;
            color: #721c24;
        }
        .execution-time {
            background-color: #e2e3e5;
            color: #383d41;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Hasil Analisis Sentimen</h2>
            <p class="text-muted">ID Analisis: {{ $analisa_id }}</p>
        </div>

        @if(!isset($result) || !isset($result['status']) || $result['status'] !== 'success')
        <div class="alert alert-danger">
            Tidak dapat menampilkan hasil. Data tidak valid atau terjadi kesalahan.
        </div>
        @else
        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stat-card positive h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Positif (Naive Bayes)</h5>
                        <h2 class="display-4">{{ $sentimentDistribution['NaiveBayes']['Positif'] ?? 0 }}</h2>
                        <p>{{ round(($sentimentDistribution['NaiveBayes']['Positif']/$totalData)*100, 2) }}% dari total</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card stat-card negative h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Negatif (Naive Bayes)</h5>
                        <h2 class="display-4">{{ $sentimentDistribution['NaiveBayes']['Negatif'] ?? 0 }}</h2>
                        <p>{{ round(($sentimentDistribution['NaiveBayes']['Negatif']/$totalData)*100, 2) }}% dari total</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card stat-card execution-time h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Waktu Eksekusi</h5>
                        <h2 class="display-4">{{ number_format($result['execution_time_ms']['NaiveBayes'] ?? 0, 2) }}ms</h2>
                        <p>Akurasi: {{ round($accuracy['NaiveBayes']*100, 2) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Distribusi Sentimen</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="data:image/png;base64,{{ $pieChart }}" alt="Pie Chart Sentimen" class="img-fluid chart-container">
                    </div>
                </div>
            </div>
        </div>

        <!-- Confusion Matrix -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Confusion Matrix</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Prediksi Negatif</th>
                                    <th>Prediksi Positif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Aktual Negatif</strong></td>
                                    <td>{{ $result['confusion_matrix']['matrix'][0][0] ?? 0 }}</td>
                                    <td>{{ $result['confusion_matrix']['matrix'][0][1] ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Aktual Positif</strong></td>
                                    <td>{{ $result['confusion_matrix']['matrix'][1][0] ?? 0 }}</td>
                                    <td>{{ $result['confusion_matrix']['matrix'][1][1] ?? 0 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Perbandingan Model</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Naive Bayes Accuracy
                                <span class="badge bg-primary rounded-pill">{{ round($accuracy['NaiveBayes']*100, 2) }}%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                KNN Accuracy
                                <span class="badge bg-primary rounded-pill">{{ round($accuracy['KNN']*100, 2) }}%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Naive Bayes Execution Time
                                <span class="badge bg-info rounded-pill">{{ number_format($result['execution_time_ms']['NaiveBayes'] ?? 0, 2) }}ms</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                KNN Execution Time
                                <span class="badge bg-info rounded-pill">{{ number_format($result['execution_time_ms']['KNN'] ?? 0, 2) }}ms</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Analisis (Menampilkan {{ count($displayData) }} dari {{ $totalData }} data)</h5>
                <a href="{{ $downloadUrl }}" class="btn btn-success">
                    <i class="bi bi-download"></i> Download Full Results
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Username</th>
                                <th width="30%">Teks Asli</th>
                                <th width="22.5%">Naive Bayes</th>
                                <th width="22.5%">KNN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($displayData as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['username'] ?? 'N/A' }}</td>
                                <td>{{ Str::limit($item['text'] ?? 'N/A', 100) }}</td>
                                <td class="sentiment-cell">
                                    <span class="emoji">{{ $item['nb_emoji'] ?? '❓' }}</span>
                                    <br>
                                    <small>{{ ucfirst($item['nb_prediction'] ?? 'N/A') }}</small>
                                </td>
                                <td class="sentiment-cell">
                                    <span class="emoji">{{ $item['knn_emoji'] ?? '❓' }}</span>
                                    <br>
                                    <small>{{ ucfirst($item['knn_prediction'] ?? 'N/A') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional: Add any interactive elements here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Analisis sentimen loaded');
        });
    </script>
</body>
</html>