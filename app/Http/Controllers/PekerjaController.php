<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;
use App\Traits\ValidateInput;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PekerjaController extends Controller
{
    use ValidateInput;

    public function index()
    {
        $items = Pekerja::all();
        return view('admin.pekerja.index', compact('items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validatePekerja($request);
        Pekerja::create($request->except('_token'));
        return redirect()->route('pekerja.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Pekerja $pekerja)
    {
        //
    }

    public function edit(Pekerja $pekerja)
    {
        //
    }

    public function update(Request $request, Pekerja $pekerja)
    {
        $this->validatePekerja($request);
        $pekerja->update($request->except('_token'));
        return redirect()->route('pekerja.index')->with('success', 'Update data berhasil');
    }

    public function destroy(Pekerja $pekerja)
    {
        $pekerja->delete();
        return redirect()->route('pekerja.index')->with('delete', 'Berhasil mengapus data');
    }
}
