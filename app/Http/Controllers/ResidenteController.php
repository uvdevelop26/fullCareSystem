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

    public function index(Request $request)
    {
      
        return Inertia::render('Residentes/Index', [
            'residentes' => Residente::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('id', 'like', "%{$search}%");
                })
                ->with('persona.ciudade')
                ->orderBy('id', 'desc')
                ->paginate(8)
        ]);
    }


    public function create()
    {
        return Inertia::render('Residentes/Nuevos');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci_numero' => 'required',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'sexo' => 'required',
            'direccion' => 'required',
            'ciudade_id' => 'required',
            'fecha_ingreso' => 'required',
            'estado' => 'required',
        ]);


        $persona = Persona::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'ci_numero' => $request['ci_numero'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'telefono' => $request['telefono'],
            'edad' => $request['edad'],
            'sexo' => $request['sexo'],
            'direccion' => $request['direccion'],
            'ciudade_id' => $request['ciudade_id'],
        ]);


        Residente::create([
            'foto' => $request['foto'],
            'fecha_ingreso' => $request['fecha_ingreso'],
            'estado' => $request['estado'],
            'persona_id' => $persona->id,
        ]);

        

        return Redirect::route('residentes.index');
       
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
