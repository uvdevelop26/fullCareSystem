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


        Residente::create([
            'foto' => $request['foto'],
            'fecha_ingreso' => $request['fecha_ingreso'],
            'fecha_salida' => $request['fecha_salida'],
            'persona_id' => $persona->id,
        ]);

        // $persona->residente()->createMany($request->residentes);



        return Redirect::route('residentes.index');
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


    public function edit($id)
    {
        $persona = Persona::find($id);
        $residente = Residente::where('persona_id', $id)->get();

        return Inertia::render('Residentes/Editar', ['residente' => $residente, 'persona' => $persona]);
    }


    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($request['id']);
        $persona->nombres = $request['nombres'];
        $persona->apellidos = $request['apellidos'];
        $persona->ci_numero = $request['ci_numero'];
        $persona->fecha_nacimiento = $request['fecha_nacimiento'];
        $persona->telefono = $request['telefono'];
        $persona->edad = $request['edad'];
        $persona->sexo = $request['sexo'];
        $persona->paise_id = $request['paise_id'];
        $persona->ciudade_id = $request['ciudade_id'];
        $persona->save();

        $residente = Residente::findOrFail($request['id_residente']);
        $residente->foto = $request['foto'];
        $residente->fecha_ingreso = $request['fecha_ingreso'];
        $residente->fecha_salida = $request['fecha_salida'];
        $residente->persona_id = $request['id'];
        $residente->save();

        return Redirect::route('residentes.index');

       
    }


    public function destroy(Residente $residente)
    {
        //
    }
}
