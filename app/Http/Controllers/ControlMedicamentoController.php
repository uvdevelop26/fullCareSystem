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
    public function index(Request $request)
    {
        $queries = ['search_residente', 'search_fecha'];

        $controlMedicamentos = ControlMedicamento::with('user', 'horarioMedicamento.medicamentos.residente.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('ControlMedicamento/Index', [
            'controlMedicamentos' => $controlMedicamentos,
            'filters' => $request->all($queries)
        ]);
    }

    public function store(Request $request)
    {
    }
}
