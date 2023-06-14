<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacacioneRequest;
use App\Models\Vacacione;
use Database\Factories\VacacioneFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VacacioneController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search', 'search_estado'];
        $vacaciones = Vacacione::with('empleado.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Vacaciones/Index', [
            'vacaciones' => $vacaciones,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        return Inertia::render('Vacaciones/Nuevo');
    }


    public function store(VacacioneRequest $request)
    {

        Vacacione::create([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'estado' => $request->estado,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('vacaciones.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Vacacione $vacacione)
    {
        return Inertia::render('Vacaciones/Editar', ['vacacione' => $vacacione]);
    }


    public function update(VacacioneRequest $request, Vacacione $vacacione)
    {
        $vacacione->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $request->duracion,
            'estado' => $request->estado,
            'observacion' => $request->observacion,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('vacaciones.index');
    }


    public function destroy(Vacacione $vacacione)
    {
        $vacacione->delete();

        return Redirect::route('vacaciones.index');

    }
}
