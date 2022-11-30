<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pekerja', PekerjaController::class);
    Route::resource('kas/pembayaran', PembayaranController::class);
    Route::resource('kas/pengeluaran', PengeluaranController::class);
    Route::resource('kas/tagihan', TagihanController::class);
    // Route::post('laporan/{tahun}', [LaporanController::class, 'index'])->name('laporan.index');
});
