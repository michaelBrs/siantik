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
        Schema::create('skor_kematangan', function (Blueprint $table) {
            $table->id();
            $table->float('nilai');                  
            $table->string('rentang_nilai', 100);    
            $table->string('level', 100);            
            $table->string('status', 50);            
            $table->text('deskripsi')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor_kematangan');
    }
};