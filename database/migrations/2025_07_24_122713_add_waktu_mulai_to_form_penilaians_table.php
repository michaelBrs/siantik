<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuMulaiToFormPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            $table->timestamp('waktu_mulai')->nullable()->after('tahap_form');
            $table->boolean('status')->default(false)->after('batas_waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            $table->dropColumn(['waktu_mulai', 'status']);
        });
    }
}
