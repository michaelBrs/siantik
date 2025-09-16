<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTahunSoalToFormPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_tahun_soal')->after('tahap_form')->nullable();
            $table->foreign('id_tahun_soal')->references('id')->on('tahun_soals')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            $table->dropForeign(['id_tahun_soal']);
            $table->dropColumn('id_tahun_soal');
        });
    }
}
