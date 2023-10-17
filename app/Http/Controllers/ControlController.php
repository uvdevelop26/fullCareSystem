<?php

namespace App\Http\Controllers;

use App\Models\HorarioMedicamento;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ControlController extends Controller
{
    public function index()
    {
        $horarioMedicamentos =  HorarioMedicamento::has('medicamentos')
            ->with('medicamentos.residente.persona')
            ->orderBy('id', 'desc')
            ->get();
        

        return Inertia::render('Control/Controlmed', ['horarioMedicamentos' => $horarioMedicamentos]);
    }

    public function store(Request $request){

        return $request;
    }


    
}
