<?php

namespace App\Http\Controllers;

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


        $totalResidentes = Residente::count();

        $mesActual = Carbon::now()->month;

        $cumpleanioResidentes = Residente::with('persona')->whereHas('persona', function ($query) use ($mesActual) {
            $query->whereMonth('fecha_nacimiento', $mesActual);
        })->get();


        /*   return Inertia::render('Dashboard/Index', [
            'totalResidentes', $totalResidentes
        ]); */


        return Inertia::render('Dashboard/Index', [
            'totalResidentes' => $totalResidentes,
            'cumpleanioResidentes' => $cumpleanioResidentes

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
