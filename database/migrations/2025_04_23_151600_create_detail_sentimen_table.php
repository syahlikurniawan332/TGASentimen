<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_sentimen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analisa_id')->constrained('analisa_data')->onDelete('cascade');
            $table->string('username')->nullable();
            $table->text('text_asli');
            $table->text('text_bersih');
            $table->string('label_sentimen')->nullable();
            $table->string('nb_prediksi')->nullable();
            $table->string('knn_prediksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sentimen');
    }
};
