<?php

namespace App\Http\Livewire;

use App\Models\Potensi as ModelsPotensi;
use Livewire\Component;
use App\Models\Infotanah;
use App\Models\Pemiliklahan;
use App\Models\Desa as ModelsDesa;

class HalamanUser extends Component
{
    protected $infotanah, $desas, $pemiliktanah, $sum_luas_tanah, $petas;
    public $batas_lahan = [];

    public function render()
    {
        $this->infotanah = Infotanah::all();
        $this->desas = ModelsDesa::join('kecamatans', 'desas.kecamatans_id', '=', 'kecamatans.id')
            ->select('desas.*', 'kecamatans.nama_kecamatan')
            ->get();
        $this->pemiliktanah = Pemiliklahan::all();
        // sum of luas tanah
        $this->sum_luas_tanah = ModelsPotensi::sum('luas_lahan');
        $this->petas = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah',
            'infotanahs.ketinggian', 'infotanahs.kelembaban')
            ->get();
        return view('livewire.halaman-user',[
            'infotanah' => $this->infotanah,
            'desas'     => $this->desas,
            'pemiliktanah' => $this->pemiliktanah,
            'sum_luas_tanah' => $this->sum_luas_tanah,
            'petas' => $this->petas,
        ])->extends('welcome')->section('content');
    }
}
