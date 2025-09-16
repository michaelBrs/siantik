<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penilaian_soal')->constrained('penilaian_soals');
            $table->foreignId('id_jawaban')->constrained('jawabans')->onDelete('cascade');
            $table->decimal('bobot_jawaban', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_jawabans');
    }
}
