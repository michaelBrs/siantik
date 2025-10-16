<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianProfilling extends Model
{
    use HasFactory;

    protected $table = 'penilaian_profillings';

    protected $fillable = [
        'id_form_penilaian_satker',
        'id_pertanyaan_profilling',
        'jawaban',
        'keterangan',
    ];

    public function formPenilaianSatker()
    {
        return $this->belongsTo(FormPenilaianSatker::class, 'id_form_penilaian_satker');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanProfilling::class, 'id_pertanyaan_profilling');
    }
    
}
