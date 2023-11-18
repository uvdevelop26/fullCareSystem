<?php

namespace App\Http\Controllers;

use App\Models\ControlMedicamento;
use App\Models\HorarioMedicamento;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ControlMedicamentoController extends Controller
{
    public function index()
    {

        $controlMedicamentos = ControlMedicamento::with('user', 'horarioMedicamento')
            ->orderBy('id', 'desc')
            ->get();
   
        return Inertia::render('ControlMedicamento/Index', ['horarioMedicamentos' => $controlMedicamentos]); 
    }

    public function store(Request $request)
    {

        /*   $user_id = Auth::user()->id;

        ControlMedicamento::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'realizado' => $request->realizado,
            'user_id' => $user_id,
            'horario_medicamento_id' => $request->horario_medicamento_id
        ]);

        return Redirect::route('control-medicamento.index'); */
    }
}
