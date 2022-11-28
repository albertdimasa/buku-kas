<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Traits\ValidateInput;
use App\Traits\Convert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    use ValidateInput;
    use Convert;

    public function index()
    {
        $items = Tagihan::latest()->get();
        $bulan   = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        return view('admin.tagihan.index', compact('items', 'bulan'));
    }

    public function create()
    {
        //
    }

    public function check($request)
    {
        // Validasi dan convert nominal
        $this->validateTagihan($request);
        $this->convertNominal($request);

        // Menyimpan user yang sedang login
        $request['created_by'] = Auth::user()->name;
    }

    public function store(Request $request)
    {
        // Cek apakah data double
        $data = Tagihan::where([
            ['bulan', $request->bulan],
            ['tahun', $request->tahun],
        ])->count();

        if ($data > 0) {
            return redirect()->route('tagihan.index')->with('delete', "Tagihan {$request->bulan} {$request->tahun} telah ada");
        }

        $this->check($request);

        Tagihan::create($request->except('_token'));
        return redirect()->route('tagihan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Tagihan $tagihan)
    {
        //
    }

    public function edit(Tagihan $tagihan)
    {
        //
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        // Cek apakah data double
        $data = Tagihan::where([
            ['bulan', $request->bulan],
            ['tahun', $request->tahun],
        ])->count();

        if ($data > 0) {
            return redirect()->route('tagihan.index')->with('delete', "Tagihan {$request->bulan} {$request->tahun} telah ada");
        }

        $this->check($request);

        $tagihan->update($request->except('_token'));
        return redirect()->route('tagihan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        return redirect()->route('tagihan.index')->with('delete', 'Tagihan berhasil dihapus');
    }
}
