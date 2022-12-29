<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemiliklahan extends Model
{
    use HasFactory;
    protected $table = 'pemiliklahans';
    protected $fillable = [
        'nama_pemiliklahan',
        'alamat_pemiliklahan',
        'no_hp_pemiliklahan',
        'email_pemiliklahan',
    ];
}
