<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_form_penilaian_satker',
        'id_soal',
        'nilai',
    ];

    protected $casts = ['progres' => 'float'];

    public function formPenilaianSatker()
    {
        return $this->belongsTo(FormPenilaianSatker::class, 'id_form_penilaian_satker');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }

    public function jawabans()
    {
        return $this->hasMany(PenilaianJawaban::class, 'id_penilaian_soal');
    }
}
