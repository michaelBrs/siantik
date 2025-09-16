<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenilaian extends Model
{
    use HasFactory;

    protected $table = 'form_penilaians';

    protected $fillable = [
        'tahun', 'nama_form', 'tahap_form', 
        'id_tahun_soal', 'waktu_mulai', 'batas_waktu', 'status', 'keterangan',
    ];

    /**
     * Relasi ke Tahapan (one-to-many)
     */
    public function tahapan()
    {
        return $this->hasMany(Tahapan::class, 'id_form_penilaian');
    }

    public function tahunSoal()
    {
        return $this->belongsTo(TahunSoal::class, 'id_tahun_soal');
    }

    public function formPenilaianSatker()
    {
        return $this->hasOne(FormPenilaianSatker::class, 'form_penilaian_id');
    }


}
