<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'fecha' => 'required',
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
            'nro_comprobante' => 'comprobante nro',
            'categoria_id' => 'categoria'
        ];
    }
}
