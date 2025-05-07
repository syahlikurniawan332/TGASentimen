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
        Schema::create('hasil_akurasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analisa_id')->constrained('analisa_data')->onDelete('cascade');
            $table->string('metode');
            $table->float('akurasi')->nullable();
            $table->json('confusion_matrix')->nullable();
            $table->float('waktu_eksekusi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_akurasi');
    }
};
