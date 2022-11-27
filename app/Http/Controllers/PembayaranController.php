<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pekerja;
use Illuminate\Http\Request;
use App\Traits\ValidateInput;
use Illuminate\Support\Facades\File;

class PembayaranController extends Controller
{
    use ValidateInput;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items      = Pembayaran::latest()->get();
        $pekerja    = Pekerja::select('id_absen', 'nama')->get();
        $bulan      = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        // $belum_bayar = Pembayaran    
        return view('admin.pembayaran.index', compact('items', 'pekerja', 'bulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $request['tagihan'] = preg_replace('/\h*\.+\h*(?!.*\.)/', '', $request->tagihan); // Menghilangkan dots.
        $request['nominal'] = preg_replace('/\h*\.+\h*(?!.*\.)/', '', $request->nominal); // Menghilangkan dots.
        $request['nominal'] = preg_replace('/Rp./', '', $request->nominal); // Menghilangkan Rp. 

        // Upload Bukti Pembayaran Pembayaran
        $image = $request->file('bukti');
        $image->storeAs('public/bukti_pembayaran/', $image->hashName());

        $pembayaran = Pembayaran::create($request->except('_token', 'bukti'));
        $pembayaran->update([
            'bukti' => $image->hashName()
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $Pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        dd($pembayaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $Pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $Pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $Pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $Pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $Pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        File::delete(public_path('storage/bukti_pembayaran/' . $pembayaran->bukti));
        return redirect()->route('pembayaran.index')->with('delete', 'Pembayaran berhasil dihapus');
    }
}
