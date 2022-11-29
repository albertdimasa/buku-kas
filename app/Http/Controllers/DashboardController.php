<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->hasRole('admin');
        if ($user) {
            return $this->admin();
        };
        return view('user.dashboard');
    }

    public function admin()
    {
        $pekerja            = Pekerja::count();
        $total_pemasukan    = Pembayaran::sum('nominal');
        $total_pengeluaran  = Pengeluaran::sum('nominal');
        $bulan              = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $pemasukan          = Pembayaran::select('bulan', DB::raw('sum(nominal) as total'))->groupBy('bulan')->pluck('total', 'bulan', 'tahun')->all();
        $pengeluaran          = Pengeluaran::select('bulan', DB::raw('sum(nominal) as total'))->groupBy('bulan')->pluck('total', 'bulan', 'tahun')->all();

        $chart_pemasukan = array();
        for ($i = 0; $i < count($bulan); $i++) {
            if (array_key_exists($bulan[$i], $pemasukan)) {
                array_push($chart_pemasukan, $pemasukan[$bulan[$i]]);
            } else {
                array_push($chart_pemasukan, '0');
            }
        }

        $chart_pengeluaran = array();
        for ($i = 0; $i < count($bulan); $i++) {
            if (array_key_exists($bulan[$i], $pengeluaran)) {
                array_push($chart_pengeluaran, $pengeluaran[$bulan[$i]]);
            } else {
                array_push($chart_pengeluaran, '0');
            }
        }

        $saldo = $total_pemasukan - $total_pengeluaran;

        return view('admin.dashboard', compact('pekerja', 'total_pemasukan', 'total_pengeluaran', 'chart_pemasukan', 'chart_pengeluaran', 'saldo'));
    }
}
