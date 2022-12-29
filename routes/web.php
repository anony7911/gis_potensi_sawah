<?php

use App\Http\Livewire\Peta;
use App\Http\Livewire\Laporan;
use App\Http\Livewire\InfoSawah;
use App\Http\Livewire\HalamanUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Desa as LivewireDesa;
use App\Http\Livewire\Potensi as LivewirePotensi;
use App\Http\Livewire\Pemiliklahan as LivewirePemiliklahan;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/info_tanah', InfoSawah::class)->name('info_tanah');
Route::get('/desa', LivewireDesa::class)->name('desa');
Route::get('/pemilik_lahan', LivewirePemiliklahan::class)->name('pemilik_lahan');
Route::get('/potensi_sawah', LivewirePotensi::class)->name('potensi_sawah');
Route::get('/peta', Peta::class)->name('peta');
Route::get('/laporan', Laporan::class)->name('laporan');
Route::get('/', HalamanUser::class)->name('user');

