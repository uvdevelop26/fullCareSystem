<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistorialeRequest;
use App\Models\Alergia;
use App\Models\Caracteristica;
use App\Models\Enfermedade;
use App\Models\Historiale;
use App\Models\Incidencia;
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

        $historiales = Historiale::with('residente.persona', 'caracteristica', 'enfermedades', 'alergias')
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
        $enfermedades = Enfermedade::all();
        $alergias = Alergia::all();

        return Inertia::render('Historiales/Nuevo', [
            'enfermedades' => $enfermedades,
            'alergias' => $alergias
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
            if ($enfermedadeData['valor'] !== null) {
                $enfermedade = new Enfermedade([
                    'nombre' => $enfermedadeData['valor'],
                ]);

                $historiale->enfermedades()->save($enfermedade);
            }
        }

        $alergiasData = $request->alergias;

        foreach ($alergiasData as $alergiaData) {
            if ($alergiaData['valor'] !== null) {
                $alergia = new Alergia([
                    'nombre' => $alergiaData['valor'],
                ]);

                $historiale->alergias()->save($alergia);
            }
        }



        return Redirect::route('historiales.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Historiale $historiale)
    {
        $caracteristica = Caracteristica::find($historiale->caracteristica_id);

        $historialeHasEnfermedade = array_column(json_decode($historiale->enfermedades, true), 'id');

        $historialeHasAlergias = array_column(json_decode($historiale->alergias, true), 'id');

        $enfermedades = Enfermedade::all();

        $alergias = Alergia::all();


        return Inertia::render('Historiales/Editar', [
            'caracteristica' => $caracteristica,
            'historialeHasEnfermedade' => $historialeHasEnfermedade,
            'historialeHasAlergias' => $historialeHasAlergias,
            'enfermedades' => $enfermedades,
            'alergias' => $alergias,
            'historiale' => $historiale
        ]);
    }


    public function update(HistorialeRequest $request, Historiale $historiale)
    {


        /*  $historiale = Historiale::findOrFail($id);
        $caracteristica = Caracteristica::findOrFail($request->id_caracteristica);
        $enfermedade = Enfermedade::findOrFail($request->id_enfermedade);



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



        return Redirect::route('historiales.index'); */
    }


    public function destroy($id)
    {
        //
    }
}
