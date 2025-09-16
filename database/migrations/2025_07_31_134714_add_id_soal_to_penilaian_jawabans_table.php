<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSoalToPenilaianJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_soal')->after('id_penilaian_soal');

            // Optional: tambahkan foreign key jika ingin relasi
            $table->foreign('id_soal')->references('id')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            $table->dropForeign(['id_soal']);
            $table->dropColumn('id_soal');
        });
    }
}
