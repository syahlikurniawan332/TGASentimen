<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilAkurasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_akurasi';
    
    protected $fillable = [
        'analisa_id',
        'metode',
        'akurasi',
        'confusion_matrix',
        'waktu_eksekusi'
    ];
    
    protected $casts = [
        'confusion_matrix' => 'array',
        'waktu_eksekusi' => 'float'
    ];
    
    // Relasi ke analisa data
    public function analisaData(): BelongsTo
    {
        return $this->belongsTo(AnalisaData::class, 'analisa_id');
    }
    
    // Menyimpan kedua hasil sekaligus
    public static function simpanHasil($analisaId, $hasilNb, $hasilKnn)
    {
        // Simpan hasil Naive Bayes
        self::create([
            'analisa_id' => $analisaId,
            'metode' => 'naive_bayes',
            'akurasi' => $hasilNb['akurasi'],
            'confusion_matrix' => $hasilNb['confusion_matrix'],
            'waktu_eksekusi' => $hasilNb['waktu_eksekusi']
        ]);
        
        // Simpan hasil KNN
        self::create([
            'analisa_id' => $analisaId,
            'metode' => 'knn',
            'akurasi' => $hasilKnn['akurasi'],
            'confusion_matrix' => $hasilKnn['confusion_matrix'],
            'waktu_eksekusi' => $hasilKnn['waktu_eksekusi']
        ]);
    }
}