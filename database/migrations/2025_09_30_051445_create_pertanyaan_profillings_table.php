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
        Schema::create('pertanyaan_profillings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_soal');
            $table->string('pertanyaan', 500); 
            $table->text('keterangan')->nullable(); 
            $table->timestamps();

            // Relasi ke tabel tahun_soal (jika ada)
            $table->foreign('id_tahun_soal')
                  ->references('id')->on('tahun_soals')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_profillings');
    }
};