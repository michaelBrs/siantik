<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_penilaian_satkers', function (Blueprint $table) {
            $table->decimal('indeks_kematangan', 5, 2)
                  ->nullable()
                  ->after('is_generate');  // setelah kolom is_generate
            $table->string('predikat_kematangan', 50)
                  ->nullable()
                  ->after('indeks_kematangan');
        });
    }

    public function down(): void
    {
        Schema::table('form_penilaian_satkers', function (Blueprint $table) {
            $table->dropColumn(['indeks_kematangan', 'predikat_kematangan']);
        });
    }
};