<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Traits\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    use Report;

    public function index(Request $request)
    {
        // Jika tahun tidak dipilih maka default adalah tahun saat ini
        if ($request->tahun != null) {
            $tahun = $request->tahun;
        } else {
            $tahun = date('Y');
        }

        $pengeluaran  = Pengeluaran::select(['bulan', 'tahun', DB::raw('sum(nominal) as total')])->where('tahun', $tahun)
            ->groupBy(['bulan', 'tahun'])
            ->get();
        $pemasukan    = Pembayaran::select(['bulan', 'tahun', DB::raw('sum(nominal) as total')])->where('tahun', $tahun)
            ->groupBy(['bulan', 'tahun'])
            ->get();

        $bulan        = $this->bulan();

        return view('admin.laporan.index', compact('pemasukan', 'pengeluaran', 'bulan', 'tahun'));
    }
}
