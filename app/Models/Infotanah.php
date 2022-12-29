<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infotanah extends Model
{
    use HasFactory;
    protected $table = 'infotanahs';
    protected $fillable = [
        'jenis_tanah',
        'ketinggian',
        'kelembaban',
    ];
}
