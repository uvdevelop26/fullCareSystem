<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutinaRequest;
use App\Models\HorarioRutina;
use App\Models\Residente;
use App\Models\Rutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RutinaController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search_nombre', 'search_residente'];

        $rutinas = Rutina::with('residente.persona', 'horarioRutinas')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Rutinas/Index', [
            'rutinas' => $rutinas,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $residentes = Residente::with('persona')->get();

        return Inertia::render('Rutinas/Nuevo', ['residentes' => $residentes]);
    }


    public function store(RutinaRequest $request)
    {
        $rutina = Rutina::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'residente_id' => $request->residente_id
        ]);

        $horariosData = $request->horarios;

        foreach ($horariosData as $horarioData) {
            if (!empty($horarioData['valor'])) {
                $horario = new HorarioRutina([
                    'hora' => $horarioData['valor'],
                ]);

                $rutina->horarioRutinas()->save($horario);
            }
        }

        return Redirect::route('rutinas.index')->with('success', 'Rutina Guardada Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Rutina $rutina)
    {
        $rutinaHasHorarios = HorarioRutina::whereIn('id', array_column(json_decode($rutina->horarioRutinas, true), 'id'))->get();

        $residentes = Residente::with('persona')->get();

        return Inertia::render('Rutinas/Editar', [
            'rutina' => $rutina,
            'rutinaHasHorarios' => $rutinaHasHorarios,
            'residentes' => $residentes
        ]);
    }


    public function update(RutinaRequest $request, Rutina $rutina)
    {
        $rutina->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'residente_id' => $request->residente_id
        ]);

        //manejo de horarios
        $rutina->horarioRutinas()->delete();

        $nuevosHorarios = $request->input('horarios', []);

        foreach ($nuevosHorarios as $horarioData) {
            $rutina->horarioRutinas()->create([
                'hora' => $horarioData['hora'],
            
            ]);
        }


        return Redirect::route('rutinas.index')->with('success', 'Rutina Actualizada Exitosamente');
    }


    public function destroy($id)
    {
        $rutina = Rutina::find($id);

        $rutina->delete();

        return Redirect::route('rutinas.index')->with('success', 'Rutina Eliminada Exitosamente');
    }
}
