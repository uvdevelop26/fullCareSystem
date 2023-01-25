<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class IngresoController extends Controller
{
    function __construct()
    {
        $this->middleware('can:ver-ingreso', ['only' => ['index']]);
        $this->middleware('can:crear-ingreso', ['only' => ['create', 'store']]);
        $this->middleware('can:editar-ingreso', ['only' => ['edit', 'update']]);
        $this->middleware('can:borrar-ingreso', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ingresos = Ingreso::orderBy('id', 'desc')->paginate(8);

        return Inertia::render(
            'Ingresos/Index',
            [
                'ingresos' => $ingresos
            ]
        );
    }


    public function create()
    {
        return Inertia::render('Ingresos/Nuevo');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'tipo' => 'required',
                'ingreso_fecha' => 'required',
                'monto' => 'required'
            ]
        );

        Ingreso::create([
            'tipo' => $request->tipo,
            'subtipo' => $request->subtipo,
            'detalle' => $request->detalle,
            'ingreso_fecha' => $request->ingreso_fecha,
            'monto' => $request->monto
        ]);

        return Redirect::route('ingresos.index')->with('success', 'Ingreso Registrado');
    }

    public function show($id)
    {
        //
    }


    public function edit(Ingreso $ingreso)
    {

        return Inertia::render('Ingresos/Editar', ['ingreso' => $ingreso]);
    }


    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate(
            [
                'tipo' => 'required',
                'ingreso_fecha' => 'required',
                'monto' => 'required'
            ]
        );
        $ingreso->update($request->all());
        return Redirect::route('ingresos.index')->with('success', 'Ingreso Actualizado');
    }


    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return Redirect::route('ingresos.index')->with('success', 'Ingreso Eliminado');
    }
}
