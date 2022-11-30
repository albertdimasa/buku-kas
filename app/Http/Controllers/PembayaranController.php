<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pekerja;
use App\Models\Tagihan;
use App\Traits\Convert;
use Illuminate\Http\Request;
use App\Traits\ValidateInput;
use Illuminate\Support\Facades\File;

class PembayaranController extends Controller
{
    use ValidateInput;
    use Convert;

    public function index()
    {
        $items      = Pembayaran::latest()->get();
        $pekerja    = Pekerja::select('id_absen', 'nama')->get();
        $bulan      = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan_lalu = now()->subMonth()->isoFormat('MMMM');

        try {
            $tagihan    = Tagihan::where([
                ['bulan', $bulan_lalu],
                ['tahun', now()->isoFormat('Y')]
            ])->first()->nominal;
        } catch (\Throwable $th) {
            $tagihan = 0;
        }

        // Cek apakah tagihan null
        $total_bulan_ini     = Pembayaran::where('bulan', $bulan_lalu)->sum('nominal');
        $pekerja_belum_bayar = Pekerja::whereNotIn('id_absen', Pembayaran::where('bulan', $bulan_lalu)->pluck('id_absen'))->count();
        return view('admin.pembayaran.index', compact('items', 'pekerja', 'bulan', 'total_bulan_ini', 'pekerja_belum_bayar', 'tagihan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request['nama']    = Pekerja::where('id_absen', $request->id_absen)->first()->nama; // Mendapatkan nama berdasar id absen

        // Cek apakah data double
        $data = Pembayaran::where([
            ['id_absen', $request->id_absen],
            ['nama', $request->nama],
            ['bulan', $request->bulan],
            ['tahun', $request->tahun],
        ])->count();

        if ($data == 1) {
            return redirect()->route('pembayaran.index')->with('delete', "{$request->nama} telah membayar pada bulan {$request->bulan} {$request->tahun}");
        }

        // Pembayaran diterima
        $this->validatePembayaran($request);
        $this->convertNominal($request);
        $request['tagihan'] = preg_replace('/\h*\.+\h*(?!.*\.)/', '', $request->tagihan); // Menghilangkan dots.

        // Upload Bukti Pembayaran
        $image = $request->file('bukti');
        $image->storeAs('public/bukti_pembayaran/', $image->hashName());

        $pembayaran = Pembayaran::create($request->except('_token', 'bukti'));
        $pembayaran->update([
            'bukti' => $image->hashName()
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function show(Pembayaran $pembayaran)
    {
    }

    public function edit(Pembayaran $Pembayaran)
    {
        //
    }

    public function update(Request $request, Pembayaran $Pembayaran)
    {
        //
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        File::delete(public_path('storage/bukti_pembayaran/' . $pembayaran->bukti));
        return redirect()->route('pembayaran.index')->with('delete', 'Pembayaran berhasil dihapus');
    }
}
