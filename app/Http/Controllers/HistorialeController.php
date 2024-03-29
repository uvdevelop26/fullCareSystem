<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistorialeRequest;
use App\Models\Alergia;
use App\Models\Caracteristica;
use App\Models\Enfermedade;
use App\Models\Historiale;
use App\Models\Incidencia;
use App\Models\Persona;
use App\Models\Residente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class HistorialeController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search', 'search_anho', 'search_mes'];

        $historiales = Historiale::with('residente.persona', 'caracteristica', 'enfermedades')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Historiales/Index', [
            'historiales' => $historiales,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        $residentes = Residente::with('persona')->get();

        $enfermedades = Enfermedade::all();

        return Inertia::render('Historiales/Nuevo', [
            'enfermedades' => $enfermedades,
            'residentes' => $residentes
        ]);
    }


    public function store(HistorialeRequest $request)
    {

        $caracteristica = Caracteristica::create([
            'peso' => $request->peso,
            'altura' => $request->altura,
            'temperatura' => $request->temperatura,
            'presion_arterial' => $request->presion_arterial,
        ]);

        $historiale = Historiale::create([
            'fecha_registro' => $request->fecha_registro,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'observaciones' => $request->observaciones,
            'residente_id' => $request->residente_id,
            'caracteristica_id' => $caracteristica->id
        ]);


        $enfermedadesData = $request->enfermedades;

        foreach ($enfermedadesData as $enfermedadeData) {
            if (!empty($enfermedadeData['valor'])) {
                $enfermedade = new Enfermedade([
                    'nombre' => $enfermedadeData['valor'],
                ]);

                $historiale->enfermedades()->save($enfermedade);
            }
        }

        return Redirect::route('historiales.index')->with('success', 'Historial Guardado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Historiale $historiale)
    {
        $caracteristica = Caracteristica::find($historiale->caracteristica_id);

        //enfermedades relacionadas al historial
        $historialeHasEnfermedade = Enfermedade::whereIn('id', array_column(json_decode($historiale->enfermedades, true), 'id'))->get();

        $residentes = Residente::with('persona')->get();


        return Inertia::render('Historiales/Editar', [
            'caracteristica' => $caracteristica,
            'historialeHasEnfermedade' => $historialeHasEnfermedade,
            'historiale' => $historiale,
            'residentes' => $residentes
        ]);
    }


    public function update(HistorialeRequest $request, Historiale $historiale)
    {
    
        $caracteristica = Caracteristica::find($historiale->caracteristica_id);

        $caracteristica->update([
            'peso' => $request->peso,
            'altura' => $request->altura,
            'temperatura' => $request->temperatura,
            'presion_arterial' => $request->presion_arterial,
        ]);

        $historiale->update([
            'fecha_registro' => $request->fecha_registro,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'observaciones' => $request->observaciones,
            'residente_id' => $request->residente_id,
            'caracteristica_id' => $caracteristica->id
        ]);

        //manejo de horarios
        $historiale->enfermedades()->delete();

        $nuevasEnfermedades = $request->input('enfermedades', []);

        foreach ($nuevasEnfermedades as $enfermedadesData) {
            $historiale->enfermedades()->create([
                'nombre' => $enfermedadesData['nombre'],

            ]);
        }

        return Redirect::route('historiales.index')->with('success', 'Historial Actualizado Exitosamente');
    }


    public function destroy($id)
    {
        $historiale = Historiale::find($id);

        $historiale->delete();

        return Redirect::route('historiales.index')->with('success', 'Historial Eliminado Exitosamente');
    }



    public function pdf(Historiale $historiale)
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $caracteristica = Caracteristica::find($historiale->caracteristica_id);

        //enfermedades relacionadas al historial
        $historialeHasEnfermedade = Enfermedade::whereIn('id', array_column(json_decode($historiale->enfermedades, true), 'id'))->get();

        $residente = Residente::find($historiale->residente_id);

        $persona = Persona::find($residente->persona_id);

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('report', compact('historiale', 'residente', 'persona', 'caracteristica', 'historialeHasEnfermedade', 'fechaActual', 'users'));

        return $pdf->stream();
    }
}
