<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use App\Http\Requests\EmpleadoRequest;
use PhpParser\Node\Stmt\Return_;


use \Illuminate\Auth\Middleware\Authorize;

class EmpleadoController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search', 'search_ciudad', 'search_seccion'];

        $empleado = Empleado::with('persona.ciudade', 'seccion')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        $ciudades = Ciudade::all();
        $seccions = Seccion::all();

        return Inertia::render('Empleados/Index', [
            'empleados' => $empleado,
            'ciudades' => $ciudades,
            'seccions' => $seccions,
            'filters' => $request->all($queries)
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


    public function store(EmpleadoRequest $request)
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

        Empleado::create([
            'fecha_inicio' => $request->fecha_inicio,
            'email' => $request->email,
            'seccion_id' => $request->seccion_id,
            'persona_id' => $persona->id
        ]);

        return Redirect::route('empleados.index');
    }


    public function show($id)
    {
        //
    }

    public function edit(Empleado $empleado)
    {
        $persona = $empleado->persona;
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


    public function update(EmpleadoRequest $request, Empleado $empleado)
    {

        $persona = Persona::find($empleado->persona_id);

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

        $empleado->update([
            'fecha_inicio' => $request->fecha_inicio,
            'email' => $request->email,
            'seccion_id' => $request->seccion_id,
            'persona_id' => $persona->id
        ]);

        return Redirect::route('empleados.index');
    }


    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        $empleado->delete();

        return Redirect::route('empleados.index');
       
    }
}
