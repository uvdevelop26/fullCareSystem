<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class EmpleadoController extends Controller
{

    public function index()
    {
        return Inertia::render('Empleados/Index', [
            'empleados' => Empleado::with('persona.ciudade', 'seccion')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }


    public function create()
    {
        $ciudades = Ciudade::all();
        $seccions = Seccion::all();
        return Inertia::render('Empleados/Nuevo', [
            'ciudades' => $ciudades,
            'seccions' => $seccions
        ]);
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
            'fecha_ingreso' => 'required',
            'email' => ['required', 'max:100', 'email'],
            'profesion' => ['required', 'max:200'],
            'seccion_id' => 'nullable',
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

        Empleado::create([
            'fecha_ingreso' => $request['fecha_ingreso'],
            'email' => $request['email'],
            'profesion' => $request['profesion'],
            'seccion_id' => $request['seccion_id'],
            'persona_id' => $persona->id

        ]);

        return Redirect::route('empleados.index')->with('success', 'Empleado Creado');
    }


    public function show($id)
    {
        //
    }

    public function edit(Empleado $empleado)
    {
        $persona = Persona::find($empleado->persona_id);
        $ciudades = Ciudade::all();
        $seccions = Seccion::all();

        return Inertia::render(
            'Empleados/Editar',
            [
                'persona' => $persona,
                'empleado' => $empleado,
                'ciudades' => $ciudades,
                'seccions' => $seccions
            ]
        );
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
            'email' => ['required', 'max:100', 'email'],
            'profesion' => ['required', 'max:200'],
            'seccion_id' => 'nullable',
        ]);

        $empleado = Empleado::find($id);
        $empleado = Empleado::where('id', $id)->first();
        $empleado->fecha_ingreso = $request['fecha_ingreso'];
        $empleado->email = $request['email'];
        $empleado->profesion = $request['profesion'];
        $empleado->seccion_id = $request['seccion_id'];
        if ($empleado->save()) {
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

            return Redirect::route('empleados.index')->with('success', 'Empleado Actualizado');
        }
    }


    public function destroy(Empleado $empleado)
    {
        $persona = Persona::find($empleado->persona_id);
        $persona = Persona::where('id', $empleado->persona_id)->first();

        $persona->delete();

        return Redirect::route('empleados.index')->with('success', 'Empleado Eliminado');
    }
}
