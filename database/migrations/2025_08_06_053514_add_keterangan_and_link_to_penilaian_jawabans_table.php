<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganAndLinkToPenilaianJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            $table->text('keterangan_pilihan')->nullable()->after('is_select');
            $table->string('link_pendukung')->nullable()->after('keterangan_pilihan');
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
            $table->dropColumn(['keterangan_pilihan', 'link_pendukung']);
        });
    }
}
