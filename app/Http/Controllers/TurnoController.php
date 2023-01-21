<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class TurnoController extends Controller
{

    public function index()
    {
        $turnos = Turno::has('dias')
            ->with('dias', 'empleado.persona')
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Turnos/Index', ['turnos' => $turnos]);
    }


    public function create()
    {
        $dias = Dia::get();
        return Inertia::render('Turnos/Nuevo', ['dias' => $dias]);
    }

    public function store(Request $request)
    {
        $turno = Turno::create([
            'turno' => $request['turno'],
            'empleado_id' => $request['empleado_id']
        ]);

        $turno->dias()->attach($request['dias']);

        return Redirect::route('turnos.index')->with('success', 'Jornada Asignada');
    }


    public function show($id)
    {
    }

    public function edit(Turno $turno)
    {
        $dias = Dia::get();
     //   $turnosHasDias = $turno->dias;

        $turnosHasDias = array_column(json_decode($turno->dias, true), 'id');

        return Inertia::render('Turnos/Editar', [
            'turno' => $turno,
            'dias' => $dias,
            'turnoHasDias' => $turnosHasDias
        ]);
    }


    public function update(Request $request, $id)
    {
        $turno = Turno::find($id);

        $turno->update([
            'turno' => $request['turno'],
            'empleado_id' => $request['empleado_id']
        ]);

        $turno->dias()->sync($request['dias']);

        return Redirect::route('turnos.index')->with('success', 'Turnos Actualizados');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();

        return Redirect::route('turnos.index')->with('success', 'Jornada Eliminada');
    }
}
