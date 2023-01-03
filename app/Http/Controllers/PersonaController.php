<?php

namespace App\Http\Controllers;

use App\Models\Familiare;
use App\Models\Persona;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PersonaController extends Controller
{

    public function index()
    {

        $personas = Persona::with('ciudade')->get();
        return Inertia::render('Residentes/Index', compact('personas'));

        /* $personas = DB::table('personas')
            ->join('familiars', 'familiars.persona_id', '=', 'personas.id')
            ->join('paises', 'personas.paise_id', '=', 'paises.id')
            ->join('ciudades', 'personas.ciudade_id', '=', 'ciudades.id')
            ->join('residentes', 'familiars.residente_id', '=', 'residentes.id')
            ->select(
                'personas.id',
                'personas.nombres',
                'personas.apellidos',
                'personas.ci_numero',
                'personas.fecha_nacimiento',
                'personas.telefono',
                'personas.edad',
                'personas.sexo',
                'familiars.parentesco',
                'familiars.email',
                'paises.nombre_pais',
                'ciudades.nombre_ciudad',
                'residentes.foto'
            )->get(); */

     //    
    }


    public function create()
    {
        return Inertia::render('Familiars/Nuevo');
    }

    public function store(Request $request)
    {
        $persona = Persona::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'ci_numero' => $request['ci_numero'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'telefono' => $request['telefono'],
            'edad' => $request['edad'],
            'sexo' => $request['sexo'],
            'paise_id' => $request['paise_id'],
            'ciudade_id' => $request['ciudade_id'],
        ]);

        Familiare::create([
            'parentesco' => $request['parentesco'],
            'email' => $request['email'],
            'residente_id' => $request['residente_id'],
            'persona_id' => $persona->id,
        ]);

        return Redirect::route('familiars.index');
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        return Redirect::route('Familiars/Editar');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
