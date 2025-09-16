<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_soal',
        'jawaban',
        'bobot_jawaban',
        'keterangan',
    ];

    // Relasi ke Soal
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }

    public function pilihans()
    {
        return $this->hasMany(Pilihan::class, 'id_jawaban');
    }
}
