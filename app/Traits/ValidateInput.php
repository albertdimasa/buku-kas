<?php

namespace App\Traits;

use Illuminate\Validation\Rule as ValidationRule;

trait ValidateInput
{

    public function validatePekerja($request)
    {
        return $this->validate($request, [
            'id_absen'          => ['required', ValidationRule::unique('pekerjas', 'id_absen')],
            'nama'              => 'required',
            'nomor_hp'          => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);
    }

    public function validateTagihan($request)
    {
        return $this->validate($request, [
            'nominal'           => 'required',
            'bulan'             => 'required',
            'tahun'             => 'required|numeric',
        ]);
    }

    public function validatePembayaran($request)
    {
        return $this->validate($request, [
            'id_absen'  => 'required',
            'tagihan'   => 'required',
            'nominal'   => 'required',
            'tanggal'   => 'required|date',
            'bulan'     => 'required',
            'tahun'     => 'required',
            'bukti'     => 'required|image|mimes:png,jpg,jpeg',
        ]);
    }

    public function validatePengeluaran($request)
    {
        return $this->validate($request, [
            'nama'      => 'required',
            'nominal'   => 'required',
            'bukti'     => 'required|image|mimes:png,jpg,jpeg',
            'tanggal'   => 'required'
        ]);
    }

    public function validateUser($request)
    {
        return $this->validate($request, [
            'name'      => 'required',
            'username'  => 'required|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
        ]);
    }
}
