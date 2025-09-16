<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal'; // Jika nama tabel Anda 'soal'

    protected $fillable = [
        'id_tahun_soal',
        'tahun',
        'soal',
        'nilai_soal',
        'nilai_target',
        'keterangan',
    ];

    public function tahunSoal()
    {
        return $this->belongsTo(TahunSoal::class, 'id_tahun_soal');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_soal');
    }
}
