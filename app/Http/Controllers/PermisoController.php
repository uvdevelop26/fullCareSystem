<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PermisoController extends Controller
{

    public function index()
    {
        return Inertia::render('Permisos/Index', [
            'permisos' => Permiso::with('empleado.persona')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Permisos/Nuevo');
    }


    public function store(Request $request)
    {
        $request->validate([
            'fecha_permiso' => 'required',
            'justificacion' => 'required',
            'empleado_id' => 'required'
        ]);

        Permiso::create([
            'fecha_permiso' => $request['fecha_permiso'],
            'justificacion' => $request['justificacion'],
            'empleado_id' => $request['empleado_id']
        ]);

        return Redirect::route('permisos.index')->with('success', 'Permiso Creado');
    }


    public function show($id)
    {
        //
    }


    public function edit(Permiso $permiso)
    {
        return Inertia::render('Permisos/Editar', ['permiso' => $permiso]);
    }


    public function update(Request $request, Permiso $permiso)
    {
        $request->validate([
            'fecha_permiso' => 'required',
            'justificacion' => 'required',
            'empleado_id' => 'required'
        ]);

        $permiso->update($request->all());


        return Redirect::route('permisos.index')->with('success', 'Permiso Creado');
    }

    public function destroy(Permiso $permiso)
    {
        $permiso->delete();

        return Redirect::route('permisos.index')->with('success', 'Permiso Eliminado');
    }
}
