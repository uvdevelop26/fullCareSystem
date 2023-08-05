<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JornadaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [ 
            'empleado_id' => 'required',
            'turno_id' => 'required',
            'nombre_dias' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'empleado_id' => 'empleado',
            'turno_id' => 'turno',
            'nombre_dias' => 'dias'
        ];
    }
}
