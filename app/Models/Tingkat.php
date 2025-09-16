<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;

    protected $table = 'tingkat';

    protected $fillable = [
        'kode',
        'nama',
        'urutan',
    ];

    // Jika ingin menambahkan relasi, contoh:
    // public function users()
    // {
    //     return $this->hasMany(UserProfile::class, 'tingkat_id');
    // }
}