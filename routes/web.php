<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pekerja', PekerjaController::class);
    Route::resource('kas/pembayaran', PembayaranController::class);
    Route::resource('kas/tagihan', TagihanController::class);

    Route::get('kas/pengeluaran', [PembayaranController::class, 'out_index'])->name('pengeluaran.index');
    Route::post('kas/pengeluaran', [PembayaranController::class, 'out_store'])->name('pengeluaran.store');
});
