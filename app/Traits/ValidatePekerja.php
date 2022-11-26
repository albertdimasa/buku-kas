<?php

namespace App\Traits;

trait ValidatePekerja
{

    public function validatePekerja($request)
    {
        return $this->validate($request, [
            'nama'              => 'required',
            'nomor_hp'          => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);
    }
}
