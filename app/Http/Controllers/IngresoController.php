<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class IngresoController extends Controller
{

    public function index()
    {
        $ingresos = Ingreso::all();
        return Inertia::render('Ingresos/Index', ['ingresos' => $ingresos]);
    }


    public function create()
    {
        return Inertia::render('Ingresos/Nuevo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_ingreso',
            'detalle',
            'fecha_ingreso',
            'monto'
        ]);

        Ingreso::create($request->all());
        return Redirect::route('ingresos.index');
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
        $ingreso->update($request->all());
        return Redirect::route('ingresos.index');
    }


    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return Redirect::route('ingresos.index');
    }
}
