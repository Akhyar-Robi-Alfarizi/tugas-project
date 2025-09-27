<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/data', function () {
    return view('data.data');
});

Route::get('/tambahdata', function () {
    return view('data.tambah');
});

Route::get('/pembayaran', function () {
    return view('pembayaran.pembayaran');
});

Route::get('/tambahpembayaran', function () {
    return view('pembayaran.tambah');
});

Route::get('/laporan', function () {
    return view('laporan');
});

