<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunSoal extends Model
{
    use HasFactory;

    protected $table = 'tahun_soals'; // Jika nama tabel Anda 'soal'

    protected $fillable = [
        'id_tahun_soal',
        'tahun',
        'deskripsi',
    ];

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_tahun_soal');
    }
}
