<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Familiare;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Requests\FamiliareRequest;
use App\Models\Residente;

class FamiliareController extends Controller
{

    public function index(Request $request)
    {

        $queries = ['search', 'search_ciudad', 'search_residente'];

        $residentes = Residente::all();

        $familiares = Familiare::with('persona.ciudade', 'residente.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();
        $ciudades = Ciudade::all();

        return Inertia::render('Familiares/Index', [
            'familiares' => $familiares,
            'ciudades' => $ciudades,
            'residentes' => $residentes,
            'filters' => $request->all($queries)
        ]);
    }

    public function create()
    {
        $residentes = Residente::with('persona')->get();
        $ciudades = Ciudade::all();

        return Inertia::render('Familiares/Nuevo', [
            'ciudades' => $ciudades,
            'residentes' => $residentes
        ]);
    }


    public function store(FamiliareRequest $request)
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

        Familiare::create([
            'parentezco' => $request->parentezco,
            'email' => $request->email,
            'residente_id' => $request->residente_id,
            'persona_id' => $persona->id,
        ]);


        return Redirect::route('familiares.index')->with('success', 'Familiar Creado Exitosamente');
    }


    public function show($id)
    {
    }


    public function edit(Familiare $familiare)
    {
        $ciudades = Ciudade::all();
        $persona = $familiare->persona;
        $residentes = Residente::with('persona')->get();

        return Inertia::render('Familiares/Editar', [
            'familiare' => $familiare,
            'persona' => $persona,
            'ciudades' => $ciudades,
            'residentes' => $residentes
        ]);
    }


    public function update(FamiliareRequest $request, Familiare $familiare)
    {

        $persona = Persona::find($familiare->persona_id);

        $persona->update([
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

        $familiare->update([
            'parentezco' => $request->parentezco,
            'email' => $request->email,
            'residente_id' => $request->residente_id,
            'persona_id' => $persona->id,
        ]);

        return Redirect::route('familiares.index')->with('success', 'Familiar Editado Exitosamente');
    }

    public function destroy($id)
    {

        $familiare = Familiare::find($id);

        $familiare->delete();

        return Redirect::route('familiares.index')->with('success', 'Familiar Eliminado Exitosamente');
    }
}
