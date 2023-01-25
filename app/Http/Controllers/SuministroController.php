<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuministroController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::has('horarios')
            ->with('horarios', 'residente.persona')
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Suministros/Index', ['medicamentos' => $medicamentos]);
    }
}
