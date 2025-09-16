<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinMaksToSkorKematanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skor_kematangan', function (Blueprint $table) {
            $table->float('min')->after('rentang_nilai')->nullable();
            $table->float('maks')->after('min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skor_kematangan', function (Blueprint $table) {
            $table->dropColumn(['min', 'maks']);
        });
    }
}
