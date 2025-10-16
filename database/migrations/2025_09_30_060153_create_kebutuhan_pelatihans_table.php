<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kebutuhan_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pertanyaan_profilling');
            $table->string('pelatihan', 255);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_pertanyaan_profilling')
                  ->references('id')
                  ->on('pertanyaan_profillings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_pelatihans');
    }
};