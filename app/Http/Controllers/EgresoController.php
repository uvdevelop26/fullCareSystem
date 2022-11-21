<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EgresoController extends Controller
{
    
    public function index()
    {
        $egresos = Egreso::all();
        return Inertia::render('Egresos/Index', ['egresos' => $egresos]);
    }

    
    public function create()
    {
        return Inertia::render('Egresos/Nuevo');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'tipo_egreso',
            'subtipo',
            'detalle',
            'fecha_egreso',
            'monto'
        ]);

        Egreso::create($request->all());

        return Redirect::route('egresos.index');
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit(Egreso $egreso)
    {
        return Inertia::render('Egresos/Editar', ['egreso' => $egreso]);
    }

    
    public function update(Request $request, Egreso $egreso)
    {
        $egreso->update($request->all());
        return Redirect::route('egresos.index');
        
    }

    
    public function destroy(Egreso $egreso)
    {
        $egreso->delete();
        return Redirect::route('egresos.index');
    }
}
