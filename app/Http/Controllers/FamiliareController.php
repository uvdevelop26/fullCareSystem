<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Familiare;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FamiliareController extends Controller
{

    public function index()
    {

        // $familiares = Persona::with('familiares')->get();

        return Inertia::render('Familiares/Index', [
            'familiares' => Familiare::with('persona.ciudade', 'residente.persona')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);



        /* return Inertia::render('Familiares/Index', [
            'familiares' => Persona::with('familiares')->get()
        ]); */
    }

    public function create()
    {
        $ciudades = Ciudade::all();
        return Inertia::render('Familiares/Nuevo', ['ciudades' => $ciudades]);
    }


    public function store(Request $request)
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
            'parentezco' => 'required',
            'email' => ['required', 'max:100', 'email'],
            'residente_id' => 'nullable'

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

        Familiare::create([
            'parentezco' => $request['parentezco'],
            'email' => $request['email'],
            'residente_id' => $request['residente_id'],
            'persona_id' => $persona->id,
        ]);

        return Redirect::route('familiares.index')->with('success', 'Familiar Creado');
    }


    public function show($id)
    {
    }


    public function edit(Familiare $familiare)
    {
        $ciudades = Ciudade::all();
        $persona = Persona::find($familiare->persona_id);

        return Inertia::render('Familiares/Editar', [
            'familiare' => $familiare,
            'persona' => $persona,
            'ciudades' => $ciudades
        ]);
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
            'parentezco' => 'required',
            'email' => ['required', 'max:100', 'email'],
            'residente_id' => 'nullable'

        ]);

        $familiare = Familiare::find($id);
        $familiare = Familiare::where('id', $id)->first();
        $familiare->parentezco = $request['parentezco'];
        $familiare->email = $request['email'];
        $familiare->residente_id = $request['residente_id'];
        if ($familiare->save()) {
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

            return Redirect::route('familiares.index')->with('success', 'Familiar Actualizado');
        }
    }

    public function destroy(Familiare $familiare)
    {
        $persona = Persona::find($familiare->persona_id);
        $persona = Persona::where('id', $familiare->persona_id)->first();

        $persona->delete();

        return Redirect::route('familiares.index')->with('success', 'Familiar Eliminado');
    }
}
