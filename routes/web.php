<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\AuthController;

// ===================================
// RUTE PUBLIK & AUTHENTICATION
// ===================================

// 1. Halaman Root: Paksa redirect ke Login jika diakses
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Rute Khusus Tamu (Belum Login)
Route::middleware(['guest'])->group(function () {
    // Menampilkan Form Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Memproses Login
    Route::post('/login', [AuthController::class, 'login']);
});

// 3. Rute Logout (Bisa diakses user yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===================================
// RUTE TERPROTEKSI (WAJIB LOGIN)
// Semua rute di bawah ini butuh login
// ===================================
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard / Menu Utama (Halaman Welcome)
    // Ini adalah halaman pertama yang dibuka setelah login berhasil
    Route::get('/dashboard', [BalitaController::class, 'index'])->name('dashboard');

    // 2. Data Balita (Tabel Lengkap)
    Route::get('/balitas', [BalitaController::class, 'data'])->name('balitas.index');

    // 3. Pencarian Balita
    Route::get('/search', [BalitaController::class, 'search'])->name('balitas.search');
    
    // 4. Status Umur Balita
    Route::get('/status', [BalitaController::class, 'status'])->name('balitas.status');
    Route::get('/status/{status}', [BalitaController::class, 'showStatusData'])->name('balitas.status.show');

    // 5. CRUD Resource (Create, Store, Show, Edit, Update, Destroy)
    // Kita kecualikan 'index' karena sudah dibuat rute custom di atas ('/balitas')
    Route::resource('balitas', BalitaController::class)->parameters([
        'balitas' => 'balita'
    ])->except(['index']);
    
    // 6. Download Data & Laporan
    Route::get('/download', [BalitaController::class, 'downloadFilter'])->name('balitas.download.filter');
    Route::get('/download/csv', [BalitaController::class, 'downloadCsv'])->name('balitas.download.csv');
});