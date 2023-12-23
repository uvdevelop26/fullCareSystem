<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamiliareRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nombres' =>  'required|max:100',
            'apellidos' => 'required|max:100',
            'ci_numero' => 'required|max:100',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|max:30',
            'edad' => 'required|min:1|max:105',
            'sexo' => 'required',
            'direccion' => 'required|max:200',
            'ciudade_id' => 'required',
            'parentezco' => 'required',
            'email' => 'required|max:100|email',
            'residente_id' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'ci_numero' => 'ci',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'ciudade_id' => 'ciudad'
        ];
    }
}
