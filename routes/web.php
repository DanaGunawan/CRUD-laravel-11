<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BarangController::class, 'index']);

Route::resource('mahasiswa', mahasiswaController::class);

Route::resource('barang', BarangController::class);
