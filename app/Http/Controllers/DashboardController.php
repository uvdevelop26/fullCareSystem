<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;
use App\Models\Persona;
use App\Models\Residente;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $habitacion1 = Habitacione::with('residentes.persona', 'residentes.estados')
            ->where('numero', 1)->get();

        $habitacion2 = Habitacione::with('residentes.persona', 'residentes.estados')
            ->where('numero', 2)->get();

        $habitacion3 = Habitacione::with('residentes.persona', 'residentes.estados')
            ->where('numero', 3)->get();

        $habitacion4 = Habitacione::with('residentes.persona', 'residentes.estados')
            ->where('numero', 4)->get();

        $habitacion5 = Habitacione::with('residentes.persona', 'residentes.estados')
            ->where('numero', 5)->get();

        return Inertia::render('Dashboard/Index', [
            'habitacion1' => $habitacion1,
            'habitacion2' => $habitacion2,
            'habitacion3' => $habitacion3,
            'habitacion4' => $habitacion4,
            'habitacion5' => $habitacion5
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
