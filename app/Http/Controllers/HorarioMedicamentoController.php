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
    public function index()
    {
        $horarioMedicamentos =  HorarioMedicamento::has('medicamentos')
            ->with('medicamentos.residente.persona')
            ->orderBy('id', 'desc')
            ->get();


        return Inertia::render('HorarioMedicamento/Index', ['horarioMedicamentos' => $horarioMedicamentos]);
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
