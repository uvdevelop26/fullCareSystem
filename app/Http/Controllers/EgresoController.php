<?php

namespace App\Http\Controllers;

use App\Http\Requests\EgresoRequest;
use App\Models\Categoria;
use App\Models\Egreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EgresoController extends Controller
{


    public function index(Request $request)
    {
        $queries = ['search_comprobante', 'search_categoria', 'search_anho', 'search_mes'];

        $egresos = Egreso::with('user', 'categoria')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();
        $categorias = Categoria::where('tipo', 'egresos')->get();

        return Inertia::render(
            'Egresos/Index',
            [
                'egresos' => $egresos,
                'categorias' => $categorias,
                'filters' => $request->all($queries)
            ]
        );
    }


    public function create()
    {
        $categorias = Categoria::where('tipo', 'egresos')->get();

        return Inertia::render('Egresos/Nuevo', ['categorias' => $categorias]);
    }


    public function store(EgresoRequest $request)
    {
        $user_id = Auth::user()->id;

        Egreso::create([
            'fecha' => $request->fecha,
            'concepto' => $request->concepto,
            'detalle' => $request->detalle,
            'monto' => $request->monto,
            'nro_comprobante' => $request->nro_comprobante,
            'user_id' => $user_id,
            'categoria_id' => $request->categoria_id
        ]);

        return Redirect::route('egresos.index')->with('success', 'Egreso Guardado Exitosamente');
    }


    public function show($id)
    {
        //
    }


    public function edit(Egreso $egreso)
    {
        $categorias = Categoria::where('tipo', 'egresos')->get();

        return Inertia::render('Egresos/Editar', [
            'egreso' => $egreso,
            'categorias' => $categorias
        ]);
    }


    public function update(EgresoRequest $request, Egreso $egreso)
    {
        $user_id = Auth::user()->id;

        $egreso->update([
            'fecha' => $request->fecha,
            'concepto' => $request->concepto,
            'detalle' => $request->detalle,
            'monto' => $request->monto,
            'nro_comprobante' => $request->nro_comprobante,
            'user_id' => $user_id,
            'categoria_id' => $request->categoria_id
        ]);

        return Redirect::route('egresos.index')->with('success', 'Egreso Editado Exitosamente');
    }


    public function destroy($id)
    {
        $egreso = Egreso::find($id);

        $egreso->delete();
        
        return Redirect::route('egresos.index');
    }
}
