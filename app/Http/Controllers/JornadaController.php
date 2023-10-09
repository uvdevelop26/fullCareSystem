<?php

namespace App\Http\Controllers;

use App\Http\Requests\JornadaRequest;
use App\Models\Dia;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use App\Http\Requests\TurnoRequest;
use App\Models\Familiare;
use App\Models\Jornada;

class JornadaController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_turno'];

        $jornadas = Jornada::has('dias')
            ->with('dias', 'empleado.persona', 'turno')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();
        $turnos = Turno::all();

        return Inertia::render(
            'Jornadas/Index',
            [
                'jornadas' => $jornadas,
                'turnos' => $turnos,
                'filters' => $request->all($queries)
            ]
        );

    }


    public function create()
    {
        $dias = Dia::all();
        $turnos = Turno::all();

        return Inertia::render(
            'Jornadas/Nuevo',
            [
                'dias' => $dias,
                'turnos' => $turnos
            ]
        );
    }

    public function store(JornadaRequest $request)
    {

        $jornada = Jornada::create([
            'empleado_id' => $request->empleado_id,
            'turno_id' => $request->turno_id
        ]);

        $jornada->dias()->attach($request->nombre_dias);

        return Redirect::route('jornadas.index');
    }


    public function show($id)
    {
    }

    public function edit(Jornada $jornada)
    {
        $dias = Dia::all();
        $turnos = Turno::all();

        $jornadaHasDias = array_column(json_decode($jornada->dias, true), 'id');
        //array_colum: (extrae la columna 'id', del array asociativo de php que le pasamos)
        //"json_decode" convierte un objeto json a un array asociativo de php

        return Inertia::render('Jornadas/Editar', [
            'jornada' => $jornada,
            'dias' => $dias,
            'turnos' => $turnos,
            'jornadaHasDias' => $jornadaHasDias
        ]);
    }


    public function update(JornadaRequest $request, Jornada $jornada)
    {

        $jornada->update([
            'empleado_id' => $request->empleado_id,
            'turno_id' => $request->turno_id
        ]);

        $jornada->dias()->sync($request->nombre_dias);

        return Redirect::route('jornadas.index');
    }

    public function destroy(Jornada $jornada)
    {
        $jornada->delete();

        return Redirect::route('jornadas.index');
    }
}
