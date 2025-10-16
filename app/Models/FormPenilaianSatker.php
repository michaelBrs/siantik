<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenilaianSatker extends Model
{
    use HasFactory;

    protected $fillable = ['wilayah_id', 'form_penilaian_id', 'is_generate', 'indeks_kematangan', 'predikat_kematangan', 'is_locked'];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function formPenilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'form_penilaian_id');
    }

    public function penilaianSoals()
    {
        return $this->hasMany(PenilaianSoal::class, 'id_form_penilaian_satker');
    }

    public function penilaianProfillings()
    {
        return $this->hasMany(PenilaianProfilling::class, 'id_form_penilaian_satker');
    }

}
