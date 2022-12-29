<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    use HasFactory;
    protected $table = 'potensis';
    protected $fillable = [
        'desa_id',
        'pemiliklahan_id',
        'infotanah_id',
        'luas_lahan',
        'batas_lahan',
    ];
}
