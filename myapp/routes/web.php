<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

Route::get('/login',    [UserController::class, 'loginForm'])->name('login');
Route::post('/login',   [UserController::class, 'login'])->name('login.attempt');

Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('/register',[UserController::class, 'register'])->name('register.submit');

Route::post('/logout',  [UserController::class, 'logout'])->name('logout');


Route::resource('siswa', SiswaController::class);

Route::resource('pembayaran', PembayaranController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/laporan/export/pdf',   [LaporanController::class, 'exportPdf'])->name('export.pdf');
Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('export.excel');

Route::get('/', [DashboardController::class, 'index'])->name('home');





