<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RutinaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'residente_id' => 'required',
            'horarios' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'residente_id' => 'residente',

        ];
    }
}
