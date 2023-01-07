<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth',], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => 'role:user',], function () {
        Route::get('/test', function () {
            return dd('test');
        });
    });
    Route::group(['middleware' => 'role:admin',], function () {
        Route::resource('pekerja', PekerjaController::class);
        Route::resource('kas/pembayaran', PembayaranController::class);
        Route::resource('kas/pengeluaran', PengeluaranController::class);
        Route::resource('kas/tagihan', TagihanController::class);
        Route::resource('pengguna', UserController::class);
        Route::resource('laporan', LaporanController::class);
        Route::post('laporan', [LaporanController::class, 'load_table'])->name('laporan.table');
        Route::post('pembayaran/load', [PembayaranController::class, 'load_belum_bayar'])->name('pembayaran.table');
    });
});
