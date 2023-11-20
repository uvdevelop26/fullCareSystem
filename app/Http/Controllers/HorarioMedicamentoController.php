<?php

namespace App\Http\Controllers;

use App\Http\Requests\ControlMedicamentoRequest;
use App\Models\ControlMedicamento;
use Illuminate\Http\Request;
use App\Models\HorarioMedicamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HorarioMedicamentoController extends Controller
{
    public function index(Request $request)
    {
        $queries = ['search_residente'];
        
        $horarioMedicamentos =  HorarioMedicamento::has('medicamentos')
            ->with('medicamentos.residente.persona')
            ->filter($request->only($queries))
            ->orderBy('id', 'desc')
            ->get();


        return Inertia::render('HorarioMedicamento/Index', [
            'horarioMedicamentos' => $horarioMedicamentos,
            'filters' => $request->all($queries)
        ]);
    }

    public function store(ControlMedicamentoRequest $request)
    {

        $user_id = Auth::user()->id;

        ControlMedicamento::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'realizado' => $request->realizado,
            'user_id' => $user_id,
            'horario_medicamento_id' => $request->horario_medicamento_id
        ]);

        return Redirect::route('horario-medicamentos.index')->with('success', 'Marcación Exitosa');
    }
}
