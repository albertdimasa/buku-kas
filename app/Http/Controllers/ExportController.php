<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranBelumBayarExport;
use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export Laporan Pembayaran Kas
     */
    public function pembayaran(Request $request)
    {
        return Excel::download(new PembayaranExport($request->bulan, $request->tahun), 'pembayaran.xlsx');
    }

    /**
     * Export laporan pembayaran orang belum bayar kas
     */
    public function pembayaran_belum_bayar(Request $request)
    {
        return Excel::download(new PembayaranBelumBayarExport($request->bulan, $request->tahun), 'pembayaran_' . $request->bulan . '_' . $request->tahun . '.xlsx');
    }
}
