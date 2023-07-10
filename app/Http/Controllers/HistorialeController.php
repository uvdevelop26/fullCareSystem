<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use App\Models\Enfermedade;
use App\Models\Historiale;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HistorialeController extends Controller
{

    public function index()
    {
        $historiales = Historiale::with('residente.persona')
            ->orderBy('id', 'desc')
            ->paginate(8);

        return Inertia::render('Historiales/Index', [
            'historiales' => $historiales,
        ]);
    }


    public function create()
    {
        return Inertia::render('Historiales/Nuevo');
    }


    public function store(Request $request)
    {
        $request->validate([
            'fecha_historial' => 'required',
            'residente_id' => 'required',
            'peso' => 'required',
            'altura' => 'required',
            'temperatura' => 'required',
            'presion_arterial' => 'required',
            'nombre_enfermedades' => 'required',
            'tratamientos' => 'required',
            'alimentacion' => 'required',
            'recomendaciones' => 'required'
        ]);

        $caracteristica = Caracteristica::create([
            'peso' => $request['peso'],
            'altura' => $request['altura'],
            'temperatura' => $request['temperatura'],
            'presion_arterial' => $request['presion_arterial']
        ]);

        $enfermedade =  Enfermedade::create([
            'nombre_enfermedades' => $request['nombre_enfermedades'],
            'tratamientos' => $request['tratamientos'],
            'alimentacion' => $request['alimentacion'],
            'recomendaciones' => $request['recomendaciones']
        ]);

        $incidencia = Incidencia::create([
            'cirugias' => $request['cirugias'],
            'alergias' => $request['alergias'],
            'recomendaciones' => $request['recomendaciones_inc']
        ]);

        Historiale::create([
            'fecha_historial' => $request['fecha_historial'],
            'observaciones' => $request['observaciones'],
            'residente_id' => $request['residente_id'],
            'caracteristica_id' => $caracteristica->id,
            'enfermedade_id' => $enfermedade->id,
            'incidencia_id' => $incidencia->id
        ]);

        return Redirect::route('historiales.index')->with('success', 'Historial Guardado');
    }


    public function show($id)
    {
        //
    }


    public function edit(Historiale $historiale)
    {
        $caracteristica = Caracteristica::find($historiale->caracteristica_id);
        $enfermedade = Enfermedade::find($historiale->enfermedade_id);
        $incidencia = Incidencia::find($historiale->incidencia_id);

        return Inertia::render('Historiales/Editar', [
            'caracteristica' => $caracteristica,
            'enfermedade' => $enfermedade,
            'incidencia' => $incidencia,
            'historiale' => $historiale
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_historial' => 'required',
            'residente_id' => 'required',
            'peso' => 'required',
            'altura' => 'required',
            'temperatura' => 'required',
            'presion_arterial' => 'required',
            'nombre_enfermedades' => 'required',
            'tratamientos' => 'required',
            'alimentacion' => 'required',
            'recomendaciones' => 'required'
        ]);

        $historiale = Historiale::findOrFail($id);
        $caracteristica = Caracteristica::findOrFail($request->id_caracteristica);
        $enfermedade = Enfermedade::findOrFail($request->id_enfermedade);
        $incidencia = Incidencia::findOrFail($request->id_incidencia);

    
        $historiale->fecha_historial = $request['fecha_historial'];
        $historiale->observaciones = $request['observaciones'];
        $historiale->residente_id = $request['residente_id'];

        $historiale->save();

        $caracteristica->peso = $request['peso'];
        $caracteristica->altura = $request['altura'];
        $caracteristica->temperatura = $request['temperatura'];
        $caracteristica->presion_arterial = $request['presion_arterial']; 

        $caracteristica->save();

        $enfermedade->nombre_enfermedades = $request['nombre_enfermedades'];
        $enfermedade->tratamientos = $request['tratamientos'];
        $enfermedade->alimentacion = $request['alimentacion'];  
        $enfermedade->recomendaciones = $request['recomendaciones'];

        $enfermedade->save();

        $incidencia->cirugias = $request['cirugias'];
        $incidencia->alergias = $request['alergias'];
        $incidencia->recomendaciones = $request['recomendaciones_inc'];

        $incidencia->save();

        return Redirect::route('historiales.index')->with('success', 'Historial Actualizado');





        /* $historiale = Historiale::find($id);
        $historiale = Historiale::where('id', $id)->first();
        $historiale->fecha_historial = $request['fecha_historial'];
        $historiale->observaciones = $request['observaciones'];
        $historiale->residente_id = $request['residente_id'];
        if($historiale->save()){
            $caracteristica = Caracteristica::find($request->id_caracteristica);
            $caracteristica = Caracteristica::where('id', $request->id_caracteristica)->first();
            $caracteristica->peso = $request['peso'];
            $caracteristica->altura = $request['altura'];
            $caracteristica->temperatura = $request['temperatura'];
            $caracteristica->presion_arterial = $request['presion_arterial']; 
        }if($caracteristica->save()){
            $enfermedade = Enfermedade::find($request->id_enfermedade);
            $enfermedade = Enfermedade::where('id', $request->id_enfermedade);
            $enfermedade->nombre_enfermedades = $request['nombre_enfermedades'];
            $enfermedade->tratamientos = $request['tratamientos'];
            $enfermedade->alimentacion = $request['alimentacion'];  
            $enfermedade->recomendaciones = $request['recomendaciones'];    
        }if($enfermedade->save()){
            $incidencia = Incidencia::find($request->id_incidencia);
            $incidencia = Incidencia::where('id', $request->id_enfermedade);
            $incidencia->cirugias = $request['cirugias'];
            $incidencia->alergias = $request['alergias'];
            $incidencia->recomendaciones = $request['recomendaciones_inc'];

            $incidencia->save();

            return Redirect::route('historiales.index')->with('success', 'Historial Actualizado');
        } */
    }


    public function destroy($id)
    {
        //
    }
}
