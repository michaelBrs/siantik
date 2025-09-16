<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSelectToPenilaianJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_jawabans', function (Blueprint $table) {
            $table->boolean('is_select')->default(0)->after('bobot_jawaban');
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
            $table->dropColumn('is_select');
        });
    }
}
