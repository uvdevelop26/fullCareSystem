<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Sueldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SueldoController extends Controller
{
    function __construct()
    {
        $this->middleware('can:ver-sueldo', ['only' => ['index', 'show']]);
        $this->middleware('can:crear-sueldo', ['only' => ['create', 'store']]);
        $this->middleware('can:editar-sueldo', ['only' => ['edit', 'update']]);
        $this->middleware('can:borrar-sueldo', ['only' => ['destroy']]);
    }

    public function index()
    {
        return Inertia::render('Sueldos/Index', [
            'sueldos' => Sueldo::with('empleado.persona')
                ->orderBy('id', 'desc')
                ->paginate(10),
            'can' => [
                'create' => Auth::user()->can('crear-permisos'),
                'edit' => Auth::user()->can('editar-permisos'),
                'delete' => Auth::user()->can('borrar-permisos'),
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Sueldos/Nuevo');
    }


    public function store(Request $request)
    {
        $request->validate([
            'monto' => 'required',
            'categoria' => ['required', 'max:200'],
            'observacion' => ['required', 'max:300'],
            'empleado_id' => 'nullable'
        ]);

        Sueldo::create([
            'monto' => $request['monto'],
            'categoria' => $request['categoria'],
            'observacion' => $request['observacion'],
            'empleado_id' => $request['empleado_id']
        ]);

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Creado');
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


    public function update(Request $request, Sueldo $sueldo)
    {
        $request->validate([
            'monto' => 'required',
            'categoria' => ['required', 'max:200'],
            'observacion' => ['required', 'max:300'],
            'empleado_id' => 'nullable'
        ]);

        $sueldo->update($request->all());

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Creado');
    }


    public function destroy(Sueldo $sueldo)
    {
        $sueldo->delete();

        return Redirect::route('sueldos.index')->with('success', 'Sueldo Eliminado');
    }
}
