<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeahlian extends Model
{
    use HasFactory;

    protected $table = 'data_keahlians';

    protected $fillable = [
        'id_pertanyaan_profilling',
        'keahlian',
        'keterangan',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanProfilling::class, 'id_pertanyaan_profilling');
    }
    
}
