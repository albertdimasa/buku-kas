<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Traits\Convert;
use App\Traits\ValidateInput;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    use ValidateInput;
    use Convert;

    public function index()
    {
        $items                  = Pengeluaran::latest()->get();
        $bulan_ini             = now()->isoFormat('MMMM');

        $pengeluaran_bulan_ini  = Pengeluaran::where('bulan', $bulan_ini)->sum('nominal');
        $total_bulan_ini        = Pengeluaran::count();
        return view('admin.pengeluaran.index', compact('items', 'total_bulan_ini', 'pengeluaran_bulan_ini', 'bulan_ini'));
    }

    public function index_load(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        // Table Pembayaran
        if (request()->ajax()) {
            $data = Pengeluaran::orderBy('created_at', 'DESC');

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
                })
                // ->editColumn('bukti', function ($value) {
                //     $btn = `<a href="{{ asset('storage/bukti_pengeluaran/' . $value->bukti) }}" type="button"
                //     class="btn btn-warning btn-sm" target="_blank">Lihat Disini</a>`;
                //     return $btn;
                // })
                ->rawColumns(['bukti'])
                ->make();
        }
    }

    public function store(Request $request)
    {
        // Pengeluaran diterima
        $this->validatePengeluaran($request);
        $this->convertNominal($request);
        $bulan = Carbon::parse($request->tanggal)->isoFormat('MMMM');
        $tahun = date('Y', strtotime($request->tanggal));

        // Upload Bukti Pengeluaran
        $image = $request->file('bukti');
        $image->storeAs('public/bukti_pengeluaran/', $image->hashName());

        $pengeluaran = Pengeluaran::create($request->except('_token', 'bukti'));
        $pengeluaran->update([
            'bukti'   => $image->hashName(),
            'bulan'   => $bulan,
            'tahun'   => $tahun,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        File::delete(public_path('storage/bukti_pengeluaran/' . $pengeluaran->bukti));
        return redirect()->route('pengeluaran.index')->with('delete', 'Pengeluaran berhasil dihapus');
    }
}
