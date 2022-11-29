<?php

namespace App\Traits;

use Illuminate\Validation\Rule as ValidationRule;

trait Convert
{

    public function convertNominal($request)
    {
        while (str_contains($request->nominal, '.')) {
            $request['nominal'] = preg_replace('/\h*\.+\h*(?!.*\.)/', '', $request->nominal); // Menghilangkan dots.
        }
        $request['nominal'] = preg_replace('/Rp./', '', $request->nominal); // Menghilangkan Rp. 
        return $request;
    }
}
