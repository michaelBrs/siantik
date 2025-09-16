<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkat', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // contoh: pusat, provinsi, kabkota
            $table->string('nama');           // label tampil: Pusat, Provinsi, Kab/Kota
            $table->integer('urutan')->default(1); // 1 = pusat, 2 = provinsi, dst
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
        Schema::dropIfExists('tingkat');
    }
}
