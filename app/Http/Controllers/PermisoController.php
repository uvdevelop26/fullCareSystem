<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermisoRequest;
use App\Models\Empleado;
use App\Models\EstadoVariacione;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PermisoController extends Controller
{



    public function index(Request $request)
    {
        $queries = ['search', 'search_estado', 'search_motivo'];

        $estadoVariaciones = EstadoVariacione::all();

        $permisos = Permiso::with('empleado.persona', 'estadoVariacione')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Permisos/Index', [
            'permisos' => $permisos,
            'estadoVariaciones'=> $estadoVariaciones,
            'filters' => $request->all($queries)
        ]);
    }

    public function create()
    {
        $estadoVariaciones = EstadoVariacione::all();

        $empleados = Empleado::with('persona')->get();

        return Inertia::render(
            'Permisos/Nuevo',
            [
                'estadoVariaciones' => $estadoVariaciones,
                'empleados' => $empleados
            ]
        );
    }


    public function store(PermisoRequest $request)
    {


        Permiso::create([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'motivo' => $request->motivo,
            'empleado_id' => $request->empleado_id,
            'estado_variacione_id' => $request->estado_variacione_id
        ]);

        return Redirect::route('permisos.index')->with('success', 'Permiso Guardado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Permiso $permiso)
    {
        $estadoVariaciones = EstadoVariacione::all();

        $empleados = Empleado::with('persona')->get();

        return Inertia::render(
            'Permisos/Editar',
            [
                'permiso' => $permiso,
                'estadoVariaciones' => $estadoVariaciones,
                'empleados' => $empleados
            ]
        );
    }


    public function update(PermisoRequest $request, Permiso $permiso)
    {

        $permiso->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'motivo' => $request->motivo,
            'empleado_id' => $request->empleado_id,
            'estado_variacione_id' => $request->estado_variacione_id
        ]);

        return Redirect::route('permisos.index')->with('success', 'Permiso Editado Exitosamente');
    }

    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        
        $permiso->delete();

        return Redirect::route('permisos.index')->with('success', 'Permiso Eliminado Exitosamente');
    }
}
