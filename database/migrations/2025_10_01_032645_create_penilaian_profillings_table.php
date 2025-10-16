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
        Schema::create('penilaian_profillings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_form_penilaian_satker');
            $table->unsignedBigInteger('id_pertanyaan_profilling');
            $table->text('jawaban')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Relasi ke form_penilaian_satkers (hapus ikut terhapus)
            $table->foreign('id_form_penilaian_satker')
                  ->references('id')->on('form_penilaian_satkers')
                  ->onDelete('cascade');

            // Relasi ke pertanyaan_profillings (tanpa cascade)
            $table->foreign('id_pertanyaan_profilling')
                  ->references('id')->on('pertanyaan_profillings')
                  ->onDelete('restrict'); // defaultnya restrict/no action
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_profillings');
    }
};