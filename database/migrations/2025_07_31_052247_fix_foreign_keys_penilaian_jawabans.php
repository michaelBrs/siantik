<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeysPenilaianJawabans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            // Tambah ulang dengan referensi benar
            $table->foreign('id_penilaian_soal')->references('id')->on('penilaian_soals')->onDelete('cascade');
            $table->foreign('id_jawaban')->references('id')->on('jawabans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            $table->dropForeign(['id_penilaian_soal']);
            $table->dropForeign(['id_jawaban']);
        });
    }
}
