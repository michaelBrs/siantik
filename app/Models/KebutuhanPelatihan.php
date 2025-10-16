<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanPelatihan extends Model
{
    use HasFactory;

    protected $table = 'kebutuhan_pelatihans';

    protected $fillable = [
        'id_pertanyaan_profilling',
        'pelatihan',
        'keterangan',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanProfilling::class, 'id_pertanyaan_profilling');
    }

}
