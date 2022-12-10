<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function index()
    {
        $tahun = date('Y');
        $type = 'pemasukan';
        return view('admin.laporan.index', compact('tahun', 'type'));
    }

    public function load_table(Request $request)
    {
        // Jika tahun tidak dipilih maka default adalah tahun saat ini
        if (request()->input("tahun") != null) {
            $tahun = $request->tahun;
        } else {
            $tahun = date('Y');
        }

        try {
            if (request()->input("type") == 'pemasukan') {
                $data    = Pembayaran::select(['bulan', 'tahun', DB::raw('sum(nominal) as total')])->where('tahun', $tahun)
                    ->groupBy(['bulan', 'tahun'])
                    ->get();
            } else {
                $data  = Pengeluaran::select(['bulan', 'tahun', DB::raw('sum(nominal) as total')])->where('tahun', $tahun)
                    ->groupBy(['bulan', 'tahun'])
                    ->get();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            'data' => $data,
        ]);
    }
}
