<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLockedToFormPenilaianSatkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_penilaian_satkers', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('id');
            $table->timestamp('locked_at')->nullable()->after('is_locked');
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
            $table->dropColumn(['is_locked', 'locked_at']);
        });
    }
}
