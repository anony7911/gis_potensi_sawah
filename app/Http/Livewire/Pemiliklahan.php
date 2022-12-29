<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pemiliklahan as ModelsPemiliklahan;

class Pemiliklahan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 5;

    public $nama_pemiliklahan, $alamat_pemiliklahan, $no_hp_pemiliklahan, $email_pemiliklahan, $pemiliklahan_id;
    protected $pemiliklahans;

    public function render()
    {
        $this->pemiliklahans = ModelsPemiliklahan::where('nama_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('alamat_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('email_pemiliklahan', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.pemiliklahan', [
            'pemiliklahans' => $this->pemiliklahans,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInputFields()
    {
        $this->nama_pemiliklahan = '';
        $this->alamat_pemiliklahan = '';
        $this->no_hp_pemiliklahan = '';
        $this->email_pemiliklahan = '';
        $this->pemiliklahan_id = '';
    }

    public function pemiliklahanId($id){
        $this->pemiliklahan_id = $id;

        $pemiliklahan = ModelsPemiliklahan::find($id);
        $this->nama_pemiliklahan = $pemiliklahan->nama_pemiliklahan;
        $this->alamat_pemiliklahan = $pemiliklahan->alamat_pemiliklahan;
        $this->no_hp_pemiliklahan = $pemiliklahan->no_hp_pemiliklahan;
        $this->email_pemiliklahan = $pemiliklahan->email_pemiliklahan;

    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nama_pemiliklahan' => 'required',
            'alamat_pemiliklahan' => 'required',
            'no_hp_pemiliklahan' => 'required',
            'email_pemiliklahan' => 'required',
        ]);

        ModelsPemiliklahan::create($validatedDate);

        session()->flash('message', 'Data Pemilik Lahan Berhasil Ditambahkan.');

        $this->resetInputFields();

        $this->emit('pemiliklahanStore'); // Close model to using to jquery
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'nama_pemiliklahan' => 'required',
            'alamat_pemiliklahan' => 'required',
            'no_hp_pemiliklahan' => 'required',
            'email_pemiliklahan' => 'required',
        ]);

        if ($this->pemiliklahan_id) {
            $pemiliklahan = ModelsPemiliklahan::find($this->pemiliklahan_id);
            $pemiliklahan->update([
                'nama_pemiliklahan' => $this->nama_pemiliklahan,
                'alamat_pemiliklahan' => $this->alamat_pemiliklahan,
                'no_hp_pemiliklahan' => $this->no_hp_pemiliklahan,
                'email_pemiliklahan' => $this->email_pemiliklahan,
            ]);
            $this->resetInputFields();
            $this->emit('pemiliklahanUpdate'); // Close model to using to jquery
            session()->flash('message', 'Data Pemilik Lahan Berhasil Diupdate.');
        }
    }

    public function delete()
    {
        if ($this->pemiliklahan_id) {
            ModelsPemiliklahan::where('id', $this->pemiliklahan_id)->delete();
            session()->flash('message', 'Data Pemilik Lahan Berhasil Dihapus.');
        }
    }
}
