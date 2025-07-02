<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSentimen extends Model
{
    use HasFactory;

    protected $table = 'detail_sentimen';
    
    protected $fillable = [
        'analisa_id',
        'username',
        'text_asli',
        'text_bersih',
        'nb_prediksi',
        'knn_prediksi',
        'true_label',
    ];
    
    // Relasi ke analisa data
    public function analisaData(): BelongsTo
    {
        return $this->belongsTo(AnalisaData::class, 'analisa_id');
    }
}