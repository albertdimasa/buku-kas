<?php

namespace App\Exports;

use App\Models\Pekerja;
use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranBelumBayarExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $bulan;
    protected $tahun;

    function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Pekerja::select('id_absen', 'nama')->whereNotIn('id_absen', Pembayaran::where([
            ['bulan', $this->bulan],
            ['tahun', $this->tahun]
        ])->pluck('id_absen'))->get();
    }

    public function headings(): array
    {
        return [
            'ID Absen',
            'Nama'
        ];
    }
}
