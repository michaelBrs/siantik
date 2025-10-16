<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanProfilling extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan_profillings';

    protected $fillable = [
        'id_tahun_soal',
        'pertanyaan',
        'keterangan',
    ];

    public function tahunSoal()
    {
        return $this->belongsTo(TahunSoal::class, 'id_tahun_soal');
    }

    public function penilaians()
    {
        return $this->hasMany(PenilaianProfilling::class, 'id_pertanyaan_profilling');
    }

    public function keahlians()
    {
        return $this->hasMany(DataKeahlian::class, 'id_pertanyaan_profilling');
    }

    public function pelatihans()
    {
        return $this->hasMany(KebutuhanPelatihan::class, 'id_pertanyaan_profilling');
    }
    

}
