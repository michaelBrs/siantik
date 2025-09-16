<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penilaian_soal',
        'id_soal',
        'id_jawaban',
        'bobot_jawaban',
        'is_select',
    ];

    public function penilaianSoal()
    {
        return $this->belongsTo(PenilaianSoal::class, 'id_penilaian_soal');
    }

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class, 'id_jawaban');
    }

    public function penilaianPilihans()
    {
        return $this->hasMany(PenilaianPilihan::class, 'id_penilaian_jawaban');
    }
}
