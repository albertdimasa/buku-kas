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
}
