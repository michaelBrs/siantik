<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTahapan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tahapan';

    protected $fillable = [
        'nama_tahapan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi ke FormPenilaian (many-to-one)
     */
    public function formPenilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'id_form_penilaian');
    }
}
