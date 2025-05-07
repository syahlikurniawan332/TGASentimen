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
        Schema::create('analisa_data', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_fitur', ['text', 'file']);
            $table->string('nama_file')->nullable(); 
            $table->timestamp('waktu_analisis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisa_data');
    }
};
