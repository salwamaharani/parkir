<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\Halkendaraan;
use App\Livewire\Halinputparkir;
use App\Livewire\Halbayarparkir;
use App\Http\Controllers\ParkirController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', Beranda::class)->middleware('auth')->name('home');
Route::get('/kendaraan', Halkendaraan::class)->middleware('auth');
Route::get('/inputparkir', Halinputparkir::class)->middleware('auth');
Route::get('/bayarparkir', Halbayarparkir::class)->middleware('auth')->name('bayar.parkir');
