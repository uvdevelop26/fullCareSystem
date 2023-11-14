<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutinaRequest;
use App\Models\HorarioRutina;
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
        return Inertia::render('Rutinas/Nuevo');
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


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $rutina = Rutina::find($id);
        
        $rutina->delete();

        return Redirect::route('rutinas.index');
    }
}
