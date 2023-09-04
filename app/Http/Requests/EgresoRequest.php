<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EgresoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'fecha_egreso' => 'required',
            'concepto' => 'required',
            'detalle' => 'nullable',
            'monto' => 'required',
            'nro_comprobante' => 'nullable',
            'categoria_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_egreso' => 'fecha',
            'nro_comprobante' => 'comprobante nro',
            'categoria_id' => 'categoria'
        ];
    }
}