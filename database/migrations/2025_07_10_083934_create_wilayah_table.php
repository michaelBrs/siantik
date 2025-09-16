<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // custom ID, bukan auto increment
            $table->bigInteger('id_parent')->nullable()->default(-1)->comment('Wilayah induk: -1 = pusat');
            $table->string('nama_wilayah');
            $table->unsignedTinyInteger('tingkat_wilayah')->comment('0 = Pusat, 1 = Provinsi, 2 = Kabupaten/Kota, 3 = Kecamatan');
            $table->string('kode_wilayah')->unique();
            $table->string('kode_pro')->nullable();
            $table->string('kode_kab')->nullable();
            $table->string('kode_kec')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('wilayah');
    }
}
