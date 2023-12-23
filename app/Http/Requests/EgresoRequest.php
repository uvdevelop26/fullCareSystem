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
            'fecha' => 'required|date',
            'concepto' => 'required|max:100',
            'detalle' => 'nullable',
            'monto' => 'required|numeric|min:1000',
            'nro_comprobante' => 'nullable|max:50',
            'categoria_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nro_comprobante' => 'comprobante nro',
            'categoria_id' => 'categoria'
        ];
    }
}
