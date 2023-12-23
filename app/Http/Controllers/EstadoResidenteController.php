<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoResidenteRequest;
use App\Models\EstadoResidente;
use App\Models\Residente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EstadoResidenteController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search', 'search_estado'];

        $estados = EstadoResidente::with('residente.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Estados/Index', [
            'estados' => $estados,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $residentes = Residente::with('persona')->get();
        return Inertia::render(
            'Estados/Nuevo',
            ['residentes' => $residentes]
        );
    }


    public function store(EstadoResidenteRequest $request)
    {
        EstadoResidente::create([
            'nombre' => $request->nombre,
            'motivo_salida' => $request->motivo_salida,
            'fecha_salida' => $request->fecha_salida,
            'fecha_regreso' => $request->fecha_regreso,
            'residente_id' => $request->residente_id
        ]);

        return Redirect::route('estados.index')->with('success', 'Estado Registrado Exitosamente');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $estadoResidente = EstadoResidente::find($id);

        return Inertia::render('Estados/Editar', [
            'estadoResidente' => $estadoResidente
        ]);
    }


    public function update(EstadoResidenteRequest $request, $id)
    {
        $estadoResidente = EstadoResidente::find($id);

        $estadoResidente->update([
            'nombre' => $request->nombre,
            'motivo_salida' => $request->motivo_salida,
            'fecha_salida' => $request->fecha_salida,
            'fecha_regreso' => $request->fecha_regreso,
            'residente_id' => $request->residente_id
        ]);

        return Redirect::route('estados.index')->with('success', 'Estado Actualizado Correctamente');
    }


    public function destroy($id)
    {
        $estadoResidente = EstadoResidente::find($id);

        $estadoResidente->delete();

        return Redirect::route('estados.index')->with('success', 'Estado Eliminado Correctamente');
    }
}
