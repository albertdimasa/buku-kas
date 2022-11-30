<?php

namespace App\Traits;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

trait Report
{
    public function pemasukanReport()
    {
        $data = Pembayaran::select('bulan', DB::raw('sum(nominal) as total'))->where('tahun', date('Y', strtotime(now())))->groupBy('bulan', 'tahun')->pluck('total', 'bulan')->all();
        return $data;
    }

    public function pengeluaranReport()
    {
        $data = Pengeluaran::select('bulan', DB::raw('sum(nominal) as total'))->where('tahun', date('Y', strtotime(now())))->groupBy('bulan')->pluck('total', 'bulan')->all();
        return $data;
    }

    public function bulan()
    {
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        return $bulan;
    }
    
    public function chart($data)
    {
        $bulan = $this->bulan();
        $chart = array();
        for ($i = 0; $i < count($bulan); $i++) {
            if (array_key_exists($bulan[$i], $data)) {
                array_push($chart, $data[$bulan[$i]]);
            } else {
                array_push($chart, '0');
            }
        }
        return $chart;
    }
}
