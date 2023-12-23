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
        $empleados = Empleado::with('persona')->get();

        return Inertia::render('Sueldos/Nuevo', ['empleados' => $empleados]);
    }


    public function store(SueldoRequest $request)
    {

        Sueldo::create([
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'empleado_id' => $request->empleado_id
        ]);

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Creado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Sueldo $sueldo)
    {
        $empleados = Empleado::with('persona')->get();

        return Inertia::render(
            'Sueldos/Editar',
            [
                'sueldo' => $sueldo,
                'empleados' => $empleados
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

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Actualizado Exitosamente');
    }


    public function destroy($id)
    {
        $sueldo = Sueldo::find($id);

        $sueldo->delete();

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Eliminado');
    }
}
