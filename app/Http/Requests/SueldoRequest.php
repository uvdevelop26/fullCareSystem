<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SueldoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:100000',
            'empleado_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'empleado_id' => 'empleado',
        ];
    }
}
