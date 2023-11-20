<?php

namespace App\Http\Controllers;

use App\Http\Requests\ControlRutinaRequest;
use App\Models\ControlRutina;
use App\Models\HorarioRutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HorarioRutinaController extends Controller
{
    public function index(Request $request)
    {
        $queries = ['search_residente'];
        $horarioRutinas = HorarioRutina::has('rutinas')
            ->with('rutinas.residente.persona')
            ->filter($request->only($queries))
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('HorarioRutina/Index', [
            'horarioRutinas' => $horarioRutinas,
            'filters' => $request->all($queries)
        ]);
    }

    public function store(ControlRutinaRequest $request)
    {
        $user_id = Auth::user()->id;

        ControlRutina::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'realizado' => $request->realizado,
            'user_id' => $user_id,
            'horario_rutina_id' => $request->horario_rutina_id
        ]);

        return Redirect::route('horario-rutinas.index')->with('success', 'Marcación Exitosa');
    }
}
