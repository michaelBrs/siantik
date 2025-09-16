<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jawaban');
            $table->tinyInteger('tingkat')->comment('Tingkat penilaian (1-5 misalnya)');
            $table->string('keterangan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Foreign key constraint (optional)
            $table->foreign('id_jawaban')->references('id')->on('jawabans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilihans');
    }
}
