<?php

namespace App\Http\Controllers;

use App\Models\ControlRutina;
use App\Models\HorarioRutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ControlRutinaController extends Controller
{

    public function index(Request $request)
    {
        $queries = ['search_residente'];

        $controlRutinas = ControlRutina::with('user', 'horarioRutina.rutinas.residente.persona')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('ControlRutina/Index', [
            'controlRutinas' => $controlRutinas,
            'filters' => $request->all($queries)
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        /* $user_id = Auth::user()->id;

        ControlRutina::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'realizado' => $request->realizado,
            'user_id' => $user_id,
            'horario_rutina_id' => $request->horario_rutina_id
        ]);

        return Redirect::route('control-rutina.index'); */
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
