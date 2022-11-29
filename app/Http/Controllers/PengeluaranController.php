<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Traits\Convert;
use App\Traits\ValidateInput;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengeluaranController extends Controller
{
    use ValidateInput;
    use Convert;

    public function index()
    {
        $items                  = Pengeluaran::latest()->get();
        $bulan_lalu             = now()->subMonth()->isoFormat('MMMM');
        $pengeluaran_bulan_ini  = Pengeluaran::whereMonth('created_at', $bulan_lalu)->sum('nominal');
        $total_bulan_ini        = Pengeluaran::count();
        return view('admin.pengeluaran.index', compact('items', 'total_bulan_ini', 'pengeluaran_bulan_ini'));
    }

    // public function create()
    // {
    //     //
    // }

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

    // public function show(Pengeluaran $pengeluaran)
    // {
    //     //
    // }

    // public function edit(Pengeluaran $pengeluaran)
    // {
    //     //
    // }

    // public function update(Request $request, Pengeluaran $pengeluaran)
    // {
    //     //
    // }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        File::delete(public_path('storage/bukti_pengeluaran/' . $pengeluaran->bukti));
        return redirect()->route('pengeluaran.index')->with('delete', 'Pengeluaran berhasil dihapus');
    }
}
