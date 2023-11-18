<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicamentoRequest;
use App\Models\Horario;
use App\Models\HorarioMedicamento;
use App\Models\Medicamento;
use App\Models\Presentacione;
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
        return Inertia::render('Medicamentos/Nuevo', [
            'presentaciones' => $presentaciones
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
        //$horarios = Horario::get();

        //  $medicamentoHasHorario = array_column(json_decode($medicamento->horarios, true), 'id');
        $horarios = $medicamento->horarios;
        $medicamentoHasHorario = $horarios->toArray();

        $presentaciones = Presentacione::all();

        return Inertia::render('Medicamentos/Editar', [
            'medicamento' => $medicamento,
            'medicamentoHasHorario' => $medicamentoHasHorario,
            'presentaciones' => $presentaciones
        ]);
    }


    public function update(MedicamentoRequest $request, Medicamento $medicamento)
    {

        //Actualizar los datos de "medicamentos"
        $medicamento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'dosis' => $request->dosis,
            'indicaciones' => $request->indicaciones,
            'efectos_secundarios' => $request->efectos_secundarios,
            'residente_id' => $request->residente_id,
            'presentacione_id' => $request->presentacione_id
        ]);

        //recuperar horarios existentes
        $horariosExistentes = $medicamento->horarios;

        //nuevos horarios proporcionados por el usuario
        $nuevosHorarios = $request->horarios;

        //actualiza horarios existentes



        // return Redirect::route('medicamentos.index');
    }


    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
        
        $medicamento->delete();

        return Redirect::route('medicamentos.index')->with('success', 'Medicamento Eliminado Exitosamente');
    }
}
