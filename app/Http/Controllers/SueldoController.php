<?php

namespace App\Http\Controllers;

use App\Http\Requests\SueldoRequest;
use App\Models\Empleado;
use App\Models\Seccion;
use App\Models\Sueldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SueldoController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search', 'search_seccion', 'search_anho', 'search_mes'];

        $sueldos = Sueldo::with('empleado.persona', 'empleado.seccion')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();
        $seccions = Seccion::all();

        return Inertia::render('Sueldos/Index', [
            'sueldos' => $sueldos,
            'seccions' => $seccions,
            'filters' => $request->all($queries)
        ]);
    }

    public function create()
    {
        return Inertia::render('Sueldos/Nuevo');
    }


    public function store(SueldoRequest $request)
    {

        Sueldo::create([
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('sueldos.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Sueldo $sueldo)
    {
        return Inertia::render(
            'Sueldos/Editar',
            [
                'sueldo' => $sueldo
            ]
        );
    }


    public function update(SueldoRequest $request, Sueldo $sueldo)
    {
        

        $sueldo->update([
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('sueldos.index');
    }


    public function destroy(Sueldo $sueldo)
    {
        $sueldo->delete();

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Eliminado');
    }
}
