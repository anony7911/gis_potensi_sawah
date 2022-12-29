<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Potensi as ModelsPotensi;
use App\Models\Desa as ModelsDesa;
use App\Models\Pemiliklahan as ModelsPemiliklahan;
use App\Models\Infotanah as ModelsInfotanah;

class Potensi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 5;

    public $desa_id, $pemiliklahan_id, $infotanah_id, $luas_lahan, $potensi_id;
    public $pemiliklahans, $infotanahs;
    public $nama_desa, $nama_pemiliklahan, $jenis_tanah;
    protected $potensi, $desa, $pemiliklahan, $infotanah;
    public $batas_lahan = [];

    public $isTambah = false;
    public $isUpdate = false;
    public function render()
    {
        $this->potensi = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah')
            ->where('pemiliklahan_id', 'like', '%' . $this->search . '%')
            ->orWhere('infotanah_id', 'like', '%' . $this->search . '%')
            ->orWhere('luas_lahan', 'like', '%' . $this->search . '%')
            ->orWhere('batas_lahan', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        $this->desa = ModelsDesa::all();
        $this->pemiliklahan = ModelsPemiliklahan::all();
        $this->infotanah = ModelsInfotanah::all();
        $this->lahan = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah', 'infotanahs.ketinggian', 'infotanahs.kelembaban')
            ->get();
        return view('livewire.potensi', [
            'potensi' => $this->potensi,
            'desa' => $this->desa,
            'pemiliklahan' => $this->pemiliklahan,
            'infotanah' => $this->infotanah,
            'lahan' => $this->lahan,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInputFields()
    {
        $this->desa_id = '';
        $this->pemiliklahan_id = '';
        $this->infotanah_id = '';
        $this->luas_lahan = '';
        $this->batas_lahan = '';
        $this->potensi_id = '';
    }

    public function potensiId($id){
        $this->potensi_id = $id;

        $potensi = ModelsPotensi::find($id);
        $this->desa_id = $potensi->desa_id;
        $this->pemiliklahan_id = $potensi->pemiliklahan_id;
        $this->infotanah_id = $potensi->infotanah_id;
        $this->luas_lahan = $potensi->luas_lahan;
        $this->batas_lahan = $potensi->batas_lahan;

        $this->isUpdate = true;
        $this->dispatchBrowserEvent('livewire:load');
    }

    // public function lahanId($id){
    //     $this->potensi_id = $id;

    //     $lahan = ModelsPotensi::find($id);
    //     $this->desa_id = $lahan->desa_id;
    //     $this->pemiliklahan_id = $lahan->pemiliklahan_id;
    //     $this->infotanah_id = $lahan->infotanah_id;
    //     $this->luas_lahan = $lahan->luas_lahan;
    //     $this->batas_lahan = $lahan->batas_lahan;

    // }

    public function tambah()
    {
        $this->isTambah = true;
        // livewire load script
        $this->dispatchBrowserEvent('livewire:load');
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'desa_id' => 'required',
            'pemiliklahan_id' => 'required',
            'infotanah_id' => 'required',
            'luas_lahan' => 'required',
            'batas_lahan' => 'required',
        ]);

        ModelsPotensi::create($validatedDate);
        return redirect()->to('/potensi_sawah')->with('message', 'Data Berhasil Ditambahkan');
        $this->resetInputFields();
        $this->isTambah = false;
    }

    public function delete($id)
    {
        ModelsPotensi::find($id)->delete();
        return redirect()->to('/potensi_sawah')->with('message', 'Data Berhasil Dihapus');
    }
}
