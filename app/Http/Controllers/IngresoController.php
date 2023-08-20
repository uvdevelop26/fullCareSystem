<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\Categoria;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class IngresoController extends Controller
{

    public function index()
    {
        $ingresos = Ingreso::with('user', 'categoria')
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render(
            'Ingresos/Index',
            [
                'ingresos' => $ingresos
            ]
        );
    }


    public function create()
    {
        $categorias = Categoria::where('tipo', 'ingresos')->get();

        return Inertia::render('Ingresos/Nuevo', ['categorias' => $categorias]);
    }

    public function store(IngresoRequest $request)
    {
        $user_id = Auth::user()->id;

        Ingreso::create([
            'fecha_ingreso' => $request->fecha_ingreso,
            'concepto' => $request->concepto,
            'detalle' => $request->detalle,
            'monto' => $request->monto,
            'nro_comprobante' => $request->nro_comprobante,
            'user_id' => $user_id,
            'categoria_id' => $request->categoria_id
        ]);

        return Redirect::route('ingresos.index');
    }

    public function show($id)
    {
        //
    }


    public function edit(Ingreso $ingreso)
    {
        $categorias = Categoria::where('tipo', 'ingresos')->get();

        return Inertia::render(
            'Ingresos/Editar',
            [
                'ingreso' => $ingreso,
                'categorias' => $categorias
            ]
        );
    }


    public function update(IngresoRequest $request, Ingreso $ingreso)
    {
        $user_id = Auth::user()->id;

        $ingreso->update([
            'fecha_ingreso' => $request->fecha_ingreso,
            'concepto' => $request->concepto,
            'detalle' => $request->detalle,
            'monto' => $request->monto,
            'nro_comprobante' => $request->nro_comprobante,
            'user_id' => $user_id,
            'categoria_id' => $request->categoria_id
        ]);

        return Redirect::route('ingresos.index');
    }


    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        
        return Redirect::route('ingresos.index');
    }
}
