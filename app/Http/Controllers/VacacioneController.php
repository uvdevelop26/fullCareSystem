<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacacioneRequest;
use App\Models\EstadoVacacione;
use App\Models\EstadoVariacione;
use App\Models\Vacacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VacacioneController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search', 'search_estado'];

        $estadoVariaciones = EstadoVariacione::all();

        $vacaciones = Vacacione::with('empleado.persona', 'estadoVariacione')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Vacaciones/Index', [
            'vacaciones' => $vacaciones,
            'estadoVariaciones' => $estadoVariaciones,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $estadoVariaciones = EstadoVariacione::all();
        return Inertia::render(
            'Vacaciones/Nuevo',
            [
                'estadoVariaciones' => $estadoVariaciones
            ]
        );
    }


    public function store(VacacioneRequest $request)
    {

        Vacacione::create([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id,
            'estado_variacione_id' => $request->estado_variacione_id
        ]);

        return Redirect::route('vacaciones.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Vacacione $vacacione)
    {
        $estadoVariaciones = EstadoVariacione::all();
        return Inertia::render(
            'Vacaciones/Editar',
            [
                'vacacione' => $vacacione,
                'estadoVariaciones' => $estadoVariaciones
            ]
        );
    }


    public function update(VacacioneRequest $request, Vacacione $vacacione)
    {
        $vacacione->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id,
            'estado_variacione_id' => $request->estado_variacione_id,
        ]);

        return Redirect::route('vacaciones.index');
    }


    public function destroy($id)
    {
        $vacacione = Vacacione::find($id);
        
        $vacacione->delete();

        return Redirect::route('vacaciones.index');
    }
}
