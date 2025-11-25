<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BalitaController;

// Rute untuk halaman utama
Route::get('/', [BalitaController::class, 'index']);

// Rute kustom untuk menampilkan semua data balita dengan paginasi dan filter
Route::get('/balitas', [BalitaController::class, 'data'])->name('balitas.index');

// Rute kustom untuk halaman pencarian
Route::get('/search', [BalitaController::class, 'search'])->name('balitas.search');

// Rute kustom untuk status balita
Route::get('/status', [BalitaController::class, 'status'])->name('balitas.status');
Route::get('/status/{status}', [BalitaController::class, 'showStatusData'])->name('balitas.status.show');

// Rute resource tunggal untuk operasi CRUD yang tersisa (create, store, show, edit, update, destroy).
// 'parameters' digunakan untuk menyesuaikan rute agar menggunakan 'nik_balita' sebagai key, bukan 'id'.
Route::resource('balitas', BalitaController::class)->parameters([
    'balitas' => 'balita'
])->except(['index']);

// Rute untuk halaman filter & pratinjau data (Mengganti downloadView)
Route::get('/download', [BalitaController::class, 'downloadFilter'])->name('balitas.download.filter');

// Rute untuk memproses unduhan CSV
Route::get('/download/csv', [BalitaController::class, 'downloadCsv'])->name('balitas.download.csv');