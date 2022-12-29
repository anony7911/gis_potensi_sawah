<?php

namespace App\Http\Livewire;

use App\Models\Potensi as ModelsPotensi;
use Livewire\Component;

class Peta extends Component
{
    public $desa_id, $pemiliklahan_id, $infotanah_id, $luas_lahan, $potensi_id;
    public $nama_desa, $nama_pemiliklahan, $jenis_tanah, $tahun;

    protected $petas;
    public $batas_lahan = [];

    public function render()
    {
        $this->petas = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah', 'infotanahs.ketinggian', 'infotanahs.kelembaban')
            ->get();
        return view('livewire.peta', [
            'petas' => $this->petas,
        ])->extends('layouts.app')->section('content');
    }
}
