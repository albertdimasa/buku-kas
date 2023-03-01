<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pekerja;
use App\Models\Tagihan;
use App\Traits\Convert;
use Illuminate\Http\Request;
use App\Traits\ValidateInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    use ValidateInput;
    use Convert;

    public function index()
    {
        $pekerja    = Pekerja::select('id_absen', 'nama')->get();
        $bulan      = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        // Mendapatkan Tahun Ini
        $tahun      = now()->isoFormat('Y');

        // Mendapatkan Bulan Sebelumnya
        $bulan_lalu = now()->subMonth()->isoFormat('MMMM');
        try {
            if ($bulan_lalu == 'Desember') {
                $tahun = $tahun - 1;
            }
            $tagihan    = Tagihan::where([
                ['bulan', $bulan_lalu],
                ['tahun', $tahun]
            ])->first()->nominal;
        } catch (\Throwable $th) {
            $tagihan = 0;
        }

        // Kebutuhan Info Card
        $total_bulan_ini     = Pembayaran::where([
            ['bulan', $bulan_lalu],
            ['tahun', $tahun]
        ])->sum('nominal');
        $total_pekerja_belum_bayar = Pekerja::whereNotIn('id_absen', Pembayaran::where('bulan', $bulan_lalu)->pluck('id_absen'))->count();
        return view('admin.pembayaran.index', compact('bulan', 'total_bulan_ini', 'total_pekerja_belum_bayar', 'pekerja', 'tagihan'));
    }

    public function index_load(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        // Table Pembayaran
        if (request()->ajax()) {
            $data = Pembayaran::orderBy('created_at', 'DESC');

            // Jika Bulan Dipilih / Tidak Kosong
            if ($bulan != null && $tahun != null) {
                $data = $data->where([
                    ['bulan', $bulan],
                    ['tahun', $tahun]
                ]);
            }

            return DataTables::of($data)
                ->editColumn('nama', function ($value) {
                    return ucfirst($value->nama);
                })
                ->editColumn('nominal', function ($value) {
                    return 'Rp' . number_format($value->nominal, 0, '.', '.');
                })
                ->editColumn('tanggal', function ($value) {
                    return date("j F Y", strtotime($value->tanggal));
                })->make();
        }
    }


    public function belum_bayar_load(Request $request)
    {
        // Jika tahun tidak dipilih maka default adalah tahun saat ini
        if (request()->input("tahun_dipilih") != null) {
            $tahun = $request->tahun_dipilih;
        } else {
            $tahun = '';
        }

        // Jika bulan tidak dipilih maka default adalah bulan saat ini
        if (request()->input("bulan_dipilih") != null) {
            $bulan = $request->bulan_dipilih;
            } else {
                $bulan = '';
            }

        $data = Pekerja::whereNotIn('id_absen', Pembayaran::where([
            ['bulan', $bulan],
            ['tahun', $tahun]
        ])->pluck('id_absen'));

        return DataTables::of($data)
            ->editColumn('nama', function ($value) {
                return ucfirst($value->nama);
            })->make();
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

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        File::delete(public_path('storage/bukti_pembayaran/' . $pembayaran->bukti));
        return redirect()->route('pembayaran.index')->with('delete', 'Pembayaran berhasil dihapus');
    }
}
