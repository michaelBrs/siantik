<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdFormPenilaianToJadwalTahapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_tahapan', function (Blueprint $table) {
            $table->foreign('id_form_penilaian')
                  ->references('id')->on('form_penilaians')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_tahapan', function (Blueprint $table) {
            $table->dropForeign(['id_form_penilaian']);
            $table->dropColumn('id_form_penilaian');
        });
    }
}
