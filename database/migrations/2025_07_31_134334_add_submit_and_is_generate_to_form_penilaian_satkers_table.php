<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmitAndIsGenerateToFormPenilaianSatkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_penilaian_satkers', function (Blueprint $table) {
            $table->boolean('submit')->default(0)->after('form_penilaian_id');
            $table->boolean('is_generate')->default(0)->after('submit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_penilaian_satkers', function (Blueprint $table) {
            $table->dropColumn(['submit', 'is_generate']);
        });
    }
}
