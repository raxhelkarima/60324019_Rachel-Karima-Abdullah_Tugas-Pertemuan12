<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
 
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Resources route untuk Bulk Delete Operations
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])
     ->name('buku.bulk-delete');
     
// Export CSV
    Route::get('/buku/export', [BukuController::class, 'export'])
     ->name('buku.export');
 
// Custom route untuk filter kategori
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
    ->name('buku.kategori');

Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

// Resource route untuk Buku
Route::resource('buku', BukuController::class);

// Resource route untuk Anggota (akan dibuat nanti)
Route::resource('anggota', AnggotaController::class);