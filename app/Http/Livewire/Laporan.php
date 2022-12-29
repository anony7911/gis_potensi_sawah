<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Potensi as ModelsPotensi;
use App\Models\Desa as ModelsDesa;
use App\Models\Kecamatan as ModelsKecamatan;

class Laporan extends Component
{
    protected $laporans, $petas, $desas, $pemiliklahans, $infotanahs, $kecamatans;
    public $tahun, $kecamatan, $desa;

    public function render()
    {
        $this->laporans = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah', 'infotanahs.ketinggian', 'infotanahs.kelembaban')
            ->get();
        $this->desas = ModelsDesa::where('kecamatans_id', $this->kecamatan)->get();
        $this->kecamatans = ModelsKecamatan::get();
        return view('livewire.laporan',[
            'laporans' => $this->laporans,
            'desas' => $this->desas,
            'kecamatans' => $this->kecamatans,
        ])->extends('layouts.app')->section('content');
    }
        public function cetakPdf(){
            $petas = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
                ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
                ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'desas.kecamatans_id')
                ->select('potensis.*','desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah',
                'infotanahs.ketinggian', 'infotanahs.kelembaban', 'kecamatans.nama_kecamatan')
                // whereYear jika tahun TIDAK kosong
                ->when($this->tahun, function($query){
                    return $query->whereYear('potensis.created_at', $this->tahun);
                })
                // jika kecamatan TIDAK kosong
                ->when($this->kecamatan, function($query){
                    return $query->where('kecamatans_id', $this->kecamatan);
                })
                // jika desa TIDAK kosong
                ->when($this->desa, function($query){
                    return $query->where('desa_id', $this->desa);
                })
                ->get();


            $pdf = \PDF::loadView('livewire.cetakpeta', ['petas' => $petas])->output();
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf;
            }, date('Y-m-d_H:i:s') . '_cetak_laporan' . '.pdf');
        }
}
