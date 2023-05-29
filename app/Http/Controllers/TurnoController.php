<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use App\Http\Requests\TurnoRequest;
use App\Models\Familiare;

class TurnoController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_turno'];

        $turnos = Turno::has('dias')
            ->with('dias', 'empleado.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Turnos/Index', [
            'turnos' => $turnos,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $dias = Dia::all();
        return Inertia::render('Turnos/Nuevo', ['dias' => $dias]);
    }

    public function store(TurnoRequest $request)
    {

        $turno = Turno::create([
            'nombre_turnos' => $request->nombre_turnos,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'empleado_id' => $request->empleado_id
        ]);

        $turno->dias()->attach($request->nombre_dias);

        return Redirect::route('turnos.index');
    }


    public function show($id)
    {
    }

    public function edit(Turno $turno)
    {
        $dias = Dia::all();

        $turnosHasDias = array_column(json_decode($turno->dias, true), 'id');
        //array_colum: (extrae la columna 'id', del array asociativo de php que le pasamos)
        //"json_decode" convierte un objeto json a un array asociativo de php

        return Inertia::render('Turnos/Editar', [
            'turno' => $turno,
            'dias' => $dias,
            'turnoHasDias' => $turnosHasDias
        ]);
    }


    public function update(TurnoRequest $request, Turno $turno)
    {

        $turno->update([
            'nombre_turnos' => $request->nombre_turnos,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'empleado_id' => $request->empleado_id
        ]);

        $turno->dias()->sync($request->nombre_dias);

        return Redirect::route('turnos.index');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();

        return Redirect::route('turnos.index');
    }
}
