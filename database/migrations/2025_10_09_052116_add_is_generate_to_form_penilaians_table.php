<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsGenerateToFormPenilaiansTable extends Migration
{
    public function up(): void
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            $table->boolean('is_generate')->default(false)->after('status')->comment('Status apakah form sudah di generate');
        });
    }

    public function down(): void
    {
        Schema::table('form_penilaians', function (Blueprint $table) {
            $table->dropColumn('is_generate');
        });
    }
}
