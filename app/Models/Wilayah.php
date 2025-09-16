<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $fillable = [
        'id_parent',
        'nama_wilayah',
        'tingkat_wilayah',
        'kode_wilayah',
        'kode_pro',
        'kode_kab',
        'kode_kec',
        'keterangan',
    ];

    // Relasi ke parent wilayah (jika dibutuhkan)
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'id_parent');
    }

    // Relasi ke child wilayah
    public function children()
    {
        return $this->hasMany(Wilayah::class, 'id_parent');
    }

    // Relasi ke user profile
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'wilayah_id');
    }
}