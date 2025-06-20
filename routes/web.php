<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
// Route::get('/p', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/portal-p', [PortalController::class, 'indexp'])->name('admin.portal.index');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
Route::get('/parkir-motor', function () {
    return view('parkir.motor');
});

Route::get('/parkir-mobil', function () {
    return view('parkir.mobil');
});

Route::get('/jam-ramai-motor', function () {
    return view('parkir.jam-ramai-motor');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
