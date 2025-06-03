<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PortalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/parkir-motor', function () {
    return view('parkir.motor');
});

Route::get('/parkir-mobil', function () {
    return view('parkir.mobil');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
