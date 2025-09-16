<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_pilihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penilaian_jawaban');
            $table->unsignedBigInteger('id_pilihan');
            $table->boolean('is_select')->default(false);
            $table->float('nilai')->default(0);
            $table->timestamps();

            $table->foreign('id_penilaian_jawaban')->references('id')->on('penilaian_jawabans')->onDelete('cascade');
            $table->foreign('id_pilihan')->references('id')->on('pilihans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_pilihans');
    }
}
