<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        if ($this->bulan == null && $this->tahun == null) {
            return Pembayaran::select('id_absen', 'nama', 'nominal', 'bulan', 'tahun', 'tanggal')->get();
        }
        return Pembayaran::select('id_absen', 'nama', 'nominal', 'bulan', 'tahun', 'tanggal')->where([
            ['bulan', $this->bulan],
            ['tahun', $this->tahun]
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID Absen',
            'Nama',
            'Nominal',
            'Bulan',
            'Tahun',
            'Tanggal Pembayaran',

        ];
    }
}
