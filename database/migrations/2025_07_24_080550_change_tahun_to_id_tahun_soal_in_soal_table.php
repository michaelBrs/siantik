<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTahunToIdTahunSoalInSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('soal', function (Blueprint $table) {

            $table->foreign('id_tahun_soal')
                ->references('id')
                ->on('tahun_soals')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('soal', function (Blueprint $table) {
            $table->dropForeign(['id_tahun_soal']);
            $table->dropColumn('id_tahun_soal');

            $table->string('tahun', 255)->nullable(); // sesuaikan kalau sebelumnya nullable
        });
    }
}
