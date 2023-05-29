<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermisoRequest;
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
        $permisos = Permiso::with('empleado.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Permisos/Index', [
            'permisos' => $permisos,
            'filters' => $request->all($queries)
        ]);
    }

    public function create()
    {
        return Inertia::render('Permisos/Nuevo');
    }


    public function store(PermisoRequest $request)
    {


        Permiso::create([
            'fecha_permiso' => $request->fecha_permiso,
            'justificacion' => $request->justificacion,
            'estado' => $request->estado,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('permisos.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Permiso $permiso)
    {
        return Inertia::render('Permisos/Editar', ['permiso' => $permiso]);
    }


    public function update(PermisoRequest $request, Permiso $permiso)
    {

        $permiso->update([
            'fecha_permiso' => $request->fecha_permiso,
            'justificacion' => $request->justificacion,
            'estado' => $request->estado,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id
        ]);
       
        return Redirect::route('permisos.index');
    }

    public function destroy(Permiso $permiso)
    {
        $permiso->delete();

        return Redirect::route('permisos.index');
    }
}
