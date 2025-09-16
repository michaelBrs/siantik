<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_form_penilaian_satker')->constrained('form_penilaian_satkers')->onDelete('cascade');
            $table->foreignId('id_soal')->constrained('soal')->onDelete('cascade');
            $table->decimal('nilai', 5, 2)->default(0);
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
        Schema::dropIfExists('penilaian_soals');
    }
}
