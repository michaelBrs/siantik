<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorKematangan extends Model
{
    use HasFactory;
    protected $table = 'skor_kematangan';
    protected $fillable = ['nilai','rentang_nilai','level','status','deskripsi'];
}
