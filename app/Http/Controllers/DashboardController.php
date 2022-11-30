<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Traits\Report;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use Report;

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
        $pemasukan          = $this->pemasukanReport();
        $pengeluaran        = $this->pengeluaranReport();

        $chart_pemasukan    = $this->chart($pemasukan);
        $chart_pengeluaran  = $this->chart($pengeluaran);

        $saldo = $total_pemasukan - $total_pengeluaran;

        return view('admin.dashboard', compact('pekerja', 'total_pemasukan', 'total_pengeluaran', 'chart_pemasukan', 'chart_pengeluaran', 'saldo'));
    }
}
