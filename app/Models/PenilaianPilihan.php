<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPilihan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_pilihans';

    protected $fillable = [
        'id_penilaian_jawaban', 
        'id_pilihan', 
        'is_select',
        'nilai'
    ];

    public function penilaianJawaban()
    {
        return $this->belongsTo(PenilaianJawaban::class, 'id_penilaian_jawaban');
    }

    public function pilihan()
    {
        return $this->belongsTo(Pilihan::class, 'id_pilihan');
    }
}
