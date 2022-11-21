<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Residente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function GuzzleHttp\Promise\all;

class ResidenteController extends Controller
{

    public function index()
    {
        $personas = DB::table('personas')
            ->join('residentes', 'residentes.persona_id', '=', 'personas.id')
            ->join('paises', 'personas.paise_id', '=', 'paises.id')
            ->join('ciudades', 'personas.ciudade_id', '=', 'ciudades.id')
            ->select(
                'personas.id',
                'personas.nombres',
                'personas.apellidos',
                'personas.ci_numero',
                'personas.fecha_nacimiento',
                'personas.telefono',
                'personas.edad',
                'personas.sexo',
                'residentes.foto',
                'residentes.fecha_ingreso',
                'residentes.fecha_salida',
                'paises.nombre_pais',
                'ciudades.nombre_ciudad'
            )->get();

        return Inertia::render('Residentes/Index', ['personas' => $personas]);
    }


    public function create()
    {
        return Inertia::render('Residentes/Nuevos');
    }


    public function store(Request $request)
    {

       /*  $persona = Persona::create([
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

       $persona->residente()->create($request->residentes);



        return Redirect::route('residentes.index'); */
        /*  DB::transaction(function () use ($request) {

            $residentes = Persona::create($request->all());
            $residentes->residente()->create($request->residentes);

           // dd($request);

            return Redirect::route('residentes.index');
        }); */

    }


    public function show($id)
    {
        //
    }

    
    public function edit(Residente $residente)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Residente $residente)
    {
        //
    }
}
