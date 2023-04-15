<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Persona;
use App\Models\Residente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Requests\StoreResidente;
use function GuzzleHttp\Promise\all;

class ResidenteController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_ciudad', 'search_estado', 'search_sexo'];
        $residentes = Residente::with('persona.ciudade')
            ->filter($request->only($queries))
            ->get();

        $residentesData = Residente::with('persona.ciudade')
            ->get();

        $ciudades = Ciudade::all();

        return Inertia::render('Residentes/Index', [
            'residentes' => $residentes,
            'residentesData' => $residentesData,
            'filters' => $request->all($queries),
            'ciudades' => $ciudades
        ]);
    }


    public function create()
    {
        $ciudades = Ciudade::all();
        return Inertia::render('Residentes/Nuevo', ['ciudades' => $ciudades]);
    }


    public function store(StoreResidente $request)
    {

        $persona = Persona::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci_numero' => $request->ci_numero,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'direccion' => $request->direccion,
            'ciudade_id' => $request->ciudade_id,
        ]);


        Residente::create([
            'foto' => $request->foto,
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => $request->estado,
            'persona_id' => $persona->id,
        ]);



        return Redirect::route('residentes.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Residente $residente)
    {

        $persona = Persona::find($residente->persona_id);
        $ciudades = Ciudade::all();

        return Inertia::render(
            'Residentes/Editar',
            [
                'residente' => $residente,
                'persona' => $persona,
                'ciudades' => $ciudades
            ]
        );


        /* return Inertia::render('Residentes/Editar'); */

        /*   $persona = Persona::find($id);
        $residente = Residente::where('persona_id', $id)->get();

        return $persona; */

        /*   return Inertia::render('Residentes/Editar', ['residente' => $residente, 'persona' => $persona]); */
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' =>  ['required', 'max:100'],
            'apellidos' => ['required', 'max:100'],
            'ci_numero' => ['nullable', 'max:100'],
            'fecha_nacimiento' => 'required',
            'telefono' => ['nullable', 'max:30'],
            'edad' => 'required',
            'sexo' => 'required',
            'direccion' => ['required', 'max:200'],
            'ciudade_id' => 'required',
            'fecha_ingreso' => 'required',
            'estado' => 'required',
        ]);

        $residente = Residente::find($id);
        $residente = Residente::where('id', $id)->first();
        $residente->foto = $request['foto'];
        $residente->fecha_ingreso = $request['fecha_ingreso'];
        $residente->estado = $request['estado'];
        if ($residente->save()) {
            $persona = Persona::find($request->id);
            $persona = Persona::where('id', $request->id)->first();
            $persona->nombres = $request['nombres'];
            $persona->apellidos = $request['apellidos'];
            $persona->ci_numero = $request['ci_numero'];
            $persona->fecha_nacimiento = $request['fecha_nacimiento'];
            $persona->telefono = $request['telefono'];
            $persona->edad = $request['edad'];
            $persona->sexo = $request['sexo'];
            $persona->direccion = $request['direccion'];
            $persona->ciudade_id = $request['ciudade_id'];

            $persona->save();

            return Redirect::route('residentes.index')->with('success', 'Residente Actualizado');
        }

        /*  if($persona->save()){
            $residente = Residente::find($)
        }

        /* $persona = Persona::findOrFail($request['id']);
        $persona->nombres = $request['nombres'];
        $persona->apellidos = $request['apellidos'];
        $persona->ci_numero = $request['ci_numero'];
        $persona->fecha_nacimiento = $request['fecha_nacimiento'];
        $persona->telefono = $request['telefono'];
        $persona->edad = $request['edad'];
        $persona->sexo = $request['sexo'];
        $persona->direccion = $request['direccion'];
        $persona->ciudade_id = $request['ciudade_id'];
        $persona->save();

        $residente = Residente::findOrFail($request['id_residente']);
        $residente->foto = $request['foto'];
        $residente->fecha_ingreso = $request['fecha_ingreso'];
        $residente->estado = $request['estado'];
        $residente->persona_id = $request['id'];
        $residente->save();

        return Redirect::route('residentes.index'); */
    }


    public function destroy(Residente $residente)
    {
        $persona = Persona::find($residente->persona_id);
        $persona = Persona::where('id', $residente->persona_id)->first();

        $persona->delete();

        return Redirect::route('residentes.index')->with('success', 'Residente Eliminado');
    }
}
