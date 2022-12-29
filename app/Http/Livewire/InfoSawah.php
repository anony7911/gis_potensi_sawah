<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Infotanah;
use Livewire\WithPagination;

class InfoSawah extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;
    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    protected $infotanahs;
    public function mount()
    {
        $this->infotanahs = Infotanah::paginate($this->perPage);
    }
    public $jenis_tanah, $ketinggian_tanah, $kelembaban_tanah, $infotanah_id;

    public function resetInput()
    {
        $this->jenis_tanah = '';
        $this->ketinggian_tanah = '';
        $this->kelembaban_tanah = '';
        $this->infotanah_id = '';
    }
    public function render()
    {
        $this->infotanahs = Infotanah::where('jenis_tanah', 'like', '%' . $this->search . '%')->paginate($this->perPage);

        return view('livewire.info-sawah',[
            'infotanahs' => $this->infotanahs,
        ])->extends('layouts.app')->section('content');
    }

    public function store(){
        $this->validate([
            'jenis_tanah' => 'required',
            'ketinggian_tanah' => 'required',
            'kelembaban_tanah' => 'required',
        ]);

        Infotanah::create([
            'jenis_tanah' => $this->jenis_tanah,
            'ketinggian' => $this->ketinggian_tanah,
            'kelembaban' => $this->kelembaban_tanah,
        ]);

        $this->resetInput();
        $this->emit('infotanahStore');
    }

    public function tanahId($id){
        $tanah = Infotanah::find($id);
        $this->infotanah_id = $id;
        $this->jenis_tanah = $tanah->jenis_tanah;
        $this->ketinggian_tanah = $tanah->ketinggian;
        $this->kelembaban_tanah = $tanah->kelembaban;
    }

    public function update(){
        $this->validate([
            'jenis_tanah' => 'required',
            'ketinggian_tanah' => 'required',
            'kelembaban_tanah' => 'required',
        ]);

        if($this->infotanah_id){
            $tanah = Infotanah::find($this->infotanah_id);
            $tanah->update([
                'jenis_tanah' => $this->jenis_tanah,
                'ketinggian' => $this->ketinggian_tanah,
                'kelembaban' => $this->kelembaban_tanah,
            ]);
            $this->resetInput();
            $this->emit('infotanahUpdate');
        }
    }

    public function delete(){
        if($this->infotanah_id){
            Infotanah::find($this->infotanah_id)->delete();
            $this->emit('infotanahDelete');
        }
    }

}
