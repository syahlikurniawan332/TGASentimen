@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis Sentimen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sentiment-card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: none;
            overflow: hidden;
        }

        .sentiment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .sentiment-badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        .text-preview {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            border-radius: 4px;
            white-space: pre-wrap;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .accuracy-meter {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
        }

        .method-card .card-header {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .stat-card {
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header Card -->
                <div class="card sentiment-card mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="bi bi-graph-up me-2"></i>Hasil Analisis Sentimen</h4>
                            <span class="badge bg-white text-primary">ID: {{ $analisa_id }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($result['status'] === 'success')
                        <!-- Summary Stats -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="stat-card p-3 bg-white">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-muted mb-1">Total Teks</h6>
                                            <h3 class="stat-value text-primary">{{ count($textLines) }}</h3>
                                        </div>
                                        <i class="bi bi-text-paragraph text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="stat-card p-3 bg-white">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-muted mb-1">Akurasi NB</h6>
                                            <h3 class="stat-value text-success">
                                                {{ round($result['accuracy']['NaiveBayes'] * 100, 1) }}%
                                            </h3>
                                        </div>
                                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="stat-card p-3 bg-white">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-muted mb-1">Akurasi KNN</h6>
                                            <h3 class="stat-value text-info">
                                                {{ round($result['accuracy']['KNN'] * 100, 1) }}%
                                            </h3>
                                        </div>
                                        <i class="bi bi-check-circle text-info" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multi-Text Analysis -->
                        @if(count($textLines) > 1)
                        <div class="alert alert-primary d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>
                                <strong>Analisis Multi-Teks!</strong> Berikut hasil analisis {{ count($textLines) }} teks yang Anda masukkan.
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Teks Asli</th>
                                        <th class="text-center">Naive Bayes</th>
                                        <th class="text-center">KNN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($result['results'] as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ trim($item['text'], '"') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $item['NaiveBayes']['prediction'] === 'positif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($item['NaiveBayes']['prediction']) }} {{ $item['NaiveBayes']['emoji'] }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $item['KNN']['prediction'] === 'positif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($item['KNN']['prediction']) }} {{ $item['KNN']['emoji'] }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Single Text Analysis -->
                        @else
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-chat-square-text me-2"></i>Teks yang Dianalisis</h5>
                            <div class="text-preview p-3">
                                {{ $textLines[0] }}
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card method-card h-100">
                                    <div class="card-header bg-success text-white">
                                        <i class="bi bi-diagram-2 me-2"></i> Naive Bayes
                                    </div>
                                    <div class="card-body text-center py-4">
                                        @php
                                        $nb = $all_nb_predictions[0] ?? null;
                                        $nbEmoji = $nb === 'Positif' ? '😊' : '😞';
                                        @endphp

                                        @if($nb)
                                        <div class="mb-3">
                                            <span class="sentiment-badge bg-{{ $nb === 'Positif' ? 'success' : 'danger' }}" style="font-size: 1.2rem;">
                                                {{ $nb }} {{ $nbEmoji }}
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span>Akurasi</span>
                                            <span>{{ round($result['accuracy']['NaiveBayes'] * 100, 1) }}%</span>
                                        </div>
                                        <div class="accuracy-meter bg-light mb-3">
                                            <div class="bg-success" style="height: 100%; width: {{ $result['accuracy']['NaiveBayes'] * 100 }}%"></div>
                                        </div>
                                        @else
                                        <div class="text-muted">Tidak ada hasil</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card method-card h-100">
                                    <div class="card-header bg-info text-white">
                                        <i class="bi bi-diagram-3 me-2"></i> K-Nearest Neighbors
                                    </div>
                                    <div class="card-body text-center py-4">
                                        @php
                                        $knn = $all_knn_predictions[0] ?? null;
                                        $knnEmoji = $knn === 'positif' ? '😊' : '😞';
                                        @endphp

                                        @if($knn)
                                        <div class="mb-3">
                                            <span class="sentiment-badge bg-{{ $knn === 'positif' ? 'success' : 'danger' }}" style="font-size: 1.2rem;">
                                                {{ $knn }} {{ $knnEmoji }}
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <span>Akurasi</span>
                                            <span>{{ round($result['accuracy']['KNN'] * 100, 1) }}%</span>
                                        </div>
                                        <div class="accuracy-meter bg-light mb-3">
                                            <div class="bg-info" style="height: 100%; width: {{ $result['accuracy']['KNN'] * 100 }}%"></div>
                                        </div>
                                        @else
                                        <div class="text-muted">Tidak ada hasil</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Visualization -->
                        <div class="chart-container mb-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-pie-chart me-2"></i>Visualisasi Hasil</h5>
                            @if(isset($chart_base64))
                            <div class="text-center">
                                <img src="data:image/png;base64,{{ $chart_base64 }}" class="img-fluid" style="max-height: 400px;" alt="Chart Analisis Sentimen">
                                <p class="text-muted small mt-2">Distribusi sentimen berdasarkan kedua metode analisis</p>
                            </div>
                            @else
                            <div class="alert alert-warning">Visualisasi tidak tersedia</div>
                            @endif
                        </div>

                        <!-- Sentiment Distribution -->
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <i class="bi bi-bar-chart me-2"></i> Statistik Sentimen
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-success">Naive Bayes</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Positif
                                                <span class="badge bg-success rounded-pill">
                                                    {{ $result['sentiment_distribution']['NaiveBayes']['Positif'] ?? 0 }}
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Negatif
                                                <span class="badge bg-danger rounded-pill">
                                                    {{ $result['sentiment_distribution']['NaiveBayes']['Negatif'] ?? 0 }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-info">KNN</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Positif
                                                <span class="badge bg-success rounded-pill">
                                                    {{ $result['sentiment_distribution']['KNN']['Positif'] ?? 0 }}
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Negatif
                                                <span class="badge bg-danger rounded-pill">
                                                    {{ $result['sentiment_distribution']['KNN']['Negatif'] ?? 0 }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ $result['message'] ?? 'Terjadi kesalahan dalam analisis' }}
                        </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('form') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                            </a>
                            <button class="btn btn-primary" onclick="window.print()">
                                <i class="bi bi-printer me-2"></i>Cetak Hasil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection