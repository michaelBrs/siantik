<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTahapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_tahapan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tahapan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('status')->default(false); // false = tidak aktif, true = aktif
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
        Schema::dropIfExists('jadwal_tahapan');
    }
}
