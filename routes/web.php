<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/mahasiswa', function () {
    return view('mahasiswa.index');
});
