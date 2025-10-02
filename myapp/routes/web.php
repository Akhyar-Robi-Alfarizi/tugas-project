<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

// Halaman publik (hanya untuk tamu/guest)
Route::middleware('guest')->group(function () {
    Route::get('/login',    [UserController::class, 'loginForm'])->name('login');
    Route::post('/login',   [UserController::class, 'login'])->name('login.attempt');

    Route::get('/register', [UserController::class, 'registerForm'])->name('register');
    Route::post('/register',[UserController::class, 'register'])->name('register.submit');
});

Route::post('/logout',  [UserController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    // Dashboard sebagai beranda
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    Route::resource('siswa', SiswaController::class);
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/export/pdf',   [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
});





