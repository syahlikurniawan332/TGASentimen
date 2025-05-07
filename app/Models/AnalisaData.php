<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnalisaData extends Model
{
    use HasFactory;

    protected $table = 'analisa_data';
    
    protected $fillable = [
        'tipe_fitur',
        'nama_file',
        'waktu_analisis'
    ];
    
    protected $casts = [
        'waktu_analisis' => 'datetime'
    ];
    
    // Konstanta untuk tipe fitur
    public const TIPE_TEXT = 'text';
    public const TIPE_FILE = 'file';
    
    // Relasi ke detail sentimen
    public function detailSentimen(): HasMany
    {
        return $this->hasMany(DetailSentimen::class, 'analisa_id');
    }
    
    // Relasi ke hasil akurasi
    public function hasilAkurasi(): HasMany
    {
        return $this->hasMany(HasilAkurasi::class, 'analisa_id');
    }
    
    // Helper methods
    public function isTextAnalysis(): bool
    {
        return $this->tipe_fitur === self::TIPE_TEXT;
    }
    
    public function isFileAnalysis(): bool
    {
        return $this->tipe_fitur === self::TIPE_FILE;
    }
}