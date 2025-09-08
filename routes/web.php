<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandwidthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\PaketInternetController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showregisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

 Route::resource('paket_internet', PaketInternetController::class);
 Route::resource('bandwidth', BandwidthController::class);
 Route::resource('promosi', PromosiController::class);

 Route::get('/provinsi/all', [ProvinsiController::class, 'getAll']);
 Route::get('/kabupaten/by-provinsi/{provinsiId}', [KabupatenController::class, 'getByProvinsi']);
 Route::get('/kecamatan/by-kabupaten/{kabupatenId}', [KecamatanController::class, 'getByKabupaten']);
 Route::get('/kelurahan/by-kecamatan/{kecamatanId}', [KelurahanController::class, 'getByKecamatan']);

 Route::get('/transaksi/data', [TransaksiController::class, 'getData'])->name('transaksi.getData');

 Route::resource('transaksi', TransaksiController::class);
 Route::get('/transaksi/{id}/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export-pdf');

});




