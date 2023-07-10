<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Medicamento;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use PhpParser\Node\Stmt\Return_;


use \Illuminate\Auth\Middleware\Authorize;

class MedicamentoController extends Controller
{

    public function index()
    {
        $medicamentos = Medicamento::has('horarios')
            ->with('horarios', 'residente.persona')
            ->orderBy('id', 'desc')
            ->get();
        return Inertia::render('Medicamentos/Index', [
            'medicamentos' => $medicamentos,
        ]);
    }


    public function create()
    {
        $horarios = Horario::get();
        return Inertia::render('Medicamentos/Nuevo', [
            'horarios' => $horarios
        ]);
    }


    public function store(Request $request)
    {
        $medicamento = Medicamento::create([
            'nombre_medicamento' => $request['nombre_medicamento'],
            'via_suministro' => $request['via_suministro'],
            'fecha_vencimiento' => $request['fecha_vencimiento'],
            'dosis_cantidad' => $request['dosis_cantidad'],
            'stock' => $request['stock'],
            'residente_id' => $request['residente_id']
        ]);

        $medicamento->horarios()->attach($request['horarios']);

        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Registrado');
    }


    public function show($id)
    {
        //
    }


    public function edit(Medicamento $medicamento)
    {
        $horarios = Horario::get();

        $medicamentoHasHorario = array_column(json_decode($medicamento->horarios, true), 'id');

        return Inertia::render('Medicamentos/Editar', [
            'medicamento' => $medicamento,
            'horarios' => $horarios,
            'medicamentoHasHorario' => $medicamentoHasHorario
        ]);
    }


    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::find($id);
        $medicamento->update([
            'nombre_medicamento' => $request['nombre_medicamento'],
            'via_suministro' => $request['via_suministro'],
            'fecha_vencimiento' => $request['fecha_vencimiento'],
            'dosis_cantidad' => $request['dosis_cantidad'],
            'stock' => $request['stock'],
            'residente_id' => $request['residente_id']
        ]);

        $medicamento->horarios()->sync($request['horarios']);

        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Registrado');
    }


    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Registrado');
    }
}
