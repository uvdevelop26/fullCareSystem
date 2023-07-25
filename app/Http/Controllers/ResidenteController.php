<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Persona;
use App\Models\Residente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Requests\ResidenteRequest;
use App\Models\EstadoResidente;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;

class ResidenteController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_ciudad', 'search_sexo', 'search_estado'];
        $residentes = Residente::with('persona.ciudade', 'estado_residente')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        $ciudades = Ciudade::all();
        $estado_residentes = EstadoResidente::all();

        return Inertia::render('Residentes/Index', [
            'residentes' => $residentes,
            'ciudades' => $ciudades,
            'estado_residentes' => $estado_residentes,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $ciudades = Ciudade::all();
        $estado_residentes = EstadoResidente::all();
        return Inertia::render(
            'Residentes/Nuevo',
            [
                'ciudades' => $ciudades,
                'estado_residentes' => $estado_residentes
            ]
        );
    }


    public function store(ResidenteRequest $request)
    {

        $image_path = '';

        if ($request->hasFile('foto')) {
            $image_path = Storage::put('public/image', $request->file('foto'));
        }

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
            'foto' => $image_path,
            'fecha_ingreso' => $request->fecha_ingreso,
            'persona_id' => $persona->id,
            'estado_residente_id' => $request->estado_residente_id
        ]);

        sleep(1);

        return Redirect::route('residentes.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Residente $residente)
    {
        $persona = $residente->persona;
        $ciudades = Ciudade::all();
        $estado_residentes = EstadoResidente::all();

        return Inertia::render('Residentes/Editar', [
            'residente' => $residente,
            'persona' => $persona,
            'ciudades' => $ciudades,
            'estado_residentes' => $estado_residentes
        ]);
    }


    public function update(ResidenteRequest $request, Residente $residente)
    {

        $persona = Persona::find($residente->persona_id);

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

        $residente->update([
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado_residente_id' => $request->estado_residente_id,
            'persona_id' => $persona->id,
        ]);

        if ($request->file('foto')) {
            $url = Storage::put('public/image', $request->file('foto'));

            if ($residente->foto) {
                Storage::delete($residente->foto);

                $residente->update([
                    'foto' => $url
                ]);
            } else {
                $residente->update([
                    'foto' => $url
                ]);
            }
        }

        return Redirect::route('residentes.index');
    }


    public function destroy(Residente $residente)
    {
        $persona = Persona::find($residente->persona_id);

        $persona->delete();

        return Redirect::route('residentes.index');
    }
}
