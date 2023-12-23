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
use App\Models\Habitacione;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;

class ResidenteController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_ciudad', 'search_sexo'];
        
        $residentes = Residente::with('persona.ciudade', 'habitacione')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        $ciudades = Ciudade::all();


        return Inertia::render('Residentes/Index', [
            'residentes' => $residentes,
            'ciudades' => $ciudades,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $ciudades = Ciudade::all();
        $habitaciones = Habitacione::all();
        return Inertia::render(
            'Residentes/Nuevo',
            [
                'ciudades' => $ciudades,
                'habitaciones' => $habitaciones
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


        $residente = Residente::create([
            'foto' => $image_path,
            'fecha_ingreso' => $request->fecha_ingreso,
            'persona_id' => $persona->id,
            'habitacione_id' => $request->habitacione_id
        ]);

         EstadoResidente::create([
            'nombre' => 1,
            'residente_id' => $residente->id
        ]);

        sleep(1);

        return Redirect::route('residentes.index')->with('success', 'Residente Creado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Residente $residente)
    {
        $persona = $residente->persona;
        $ciudades = Ciudade::all();
        $habitaciones = Habitacione::all();

        return Inertia::render('Residentes/Editar', [
            'residente' => $residente,
            'persona' => $persona,
            'ciudades' => $ciudades,
            'habitaciones' => $habitaciones
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
            'persona_id' => $persona->id,
            'habitacione_id' => $request->habitacione_id
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

        return Redirect::route('residentes.index')->with('success', 'Residente Editado Exitosamente');
    }


    public function destroy($id)
    {
        $residente = Residente::find($id);

        $residente->delete();

        return Redirect::route('residentes.index')->with('success', 'Residente Eliminado');
    }
}
