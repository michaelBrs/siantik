<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    use HasFactory;

    protected $table = 'pilihans';

    protected $fillable = [
        'id_jawaban', 'tingkat', 'keterangan', 'deskripsi'
    ];

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class, 'id_jawaban');
    }

    public function penilaianPilihans()
    {
        return $this->hasMany(PenilaianPilihan::class, 'id_pilihan');
    }
}
