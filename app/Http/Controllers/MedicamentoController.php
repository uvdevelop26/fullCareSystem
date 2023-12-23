<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicamentoRequest;
use App\Models\Horario;
use App\Models\HorarioMedicamento;
use App\Models\Medicamento;
use App\Models\Presentacione;
use App\Models\Residente;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use PhpParser\Node\Stmt\Return_;


use \Illuminate\Auth\Middleware\Authorize;

use function PHPUnit\Framework\isEmpty;

class MedicamentoController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search_nombre', 'search_residente'];

        $medicamentos = Medicamento::with('residente.persona', 'presentacione', 'horarioMedicamentos')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Medicamentos/Index', [
            'medicamentos' => $medicamentos,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $presentaciones = Presentacione::all();

        $residentes = Residente::with('persona')->get();

        return Inertia::render('Medicamentos/Nuevo', [
            'presentaciones' => $presentaciones,
            'residentes' => $residentes
        ]);
    }


    public function store(MedicamentoRequest $request)
    {

        $medicamento = Medicamento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'dosis' => $request->dosis,
            'indicaciones' => $request->indicaciones,
            'efectos_secundarios' => $request->efectos_secundarios,
            'residente_id' => $request->residente_id,
            'presentacione_id' => $request->presentacione_id
        ]);

        $horariosData = $request->horarios;

        foreach ($horariosData as $horarioData) {
            if (!empty($horarioData['valor'])) {
                $horario = new HorarioMedicamento([
                    'hora' => $horarioData['valor'],
                ]);

                $medicamento->horarioMedicamentos()->save($horario);
            }
        }
        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Guardado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Medicamento $medicamento)
    {

        $presentaciones = Presentacione::all();

        //  $medicamentoHasHorario = array_column(json_decode($medicamento->horarios, true), 'id');

        $medicamentoHasHorarios = HorarioMedicamento::whereIn('id', array_column(json_decode($medicamento->horarioMedicamentos, true), 'id'))->get();

        $residentes = Residente::with('persona')->get();

        return Inertia::render('Medicamentos/Editar', [
            'medicamento' => $medicamento,
            'medicamentoHasHorarios' => $medicamentoHasHorarios,
            'presentaciones' => $presentaciones,
            'residentes' => $residentes
        ]);
    }


    public function update(MedicamentoRequest $request, Medicamento $medicamento)
    {

        $medicamento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'dosis' => $request->dosis,
            'indicaciones' => $request->indicaciones,
            'efectos_secundarios' => $request->efectos_secundarios,
            'residente_id' => $request->residente_id,
            'presentacione_id' => $request->presentacione_id
        ]);

        //manejo de horarios
        $medicamento->horarioMedicamentos()->delete();

        $nuevosHorarios = $request->input('horarios', []);

        foreach ($nuevosHorarios as $horarioData) {
            $medicamento->horarioMedicamentos()->create([
                'hora' => $horarioData['hora'],
            
            ]);
        }


        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Actualizado Exitosamente');

    }


    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);

        $medicamento->delete();

        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Eliminado Exitosamente');
    }
}
