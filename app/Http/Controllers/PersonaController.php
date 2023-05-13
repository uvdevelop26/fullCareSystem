<?php

namespace App\Http\Controllers;

use App\Models\Familiare;
use App\Models\Persona;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PersonaController extends Controller
{

    public function index()
    {
   
    }


    public function create()
    {
        return Inertia::render('Familiars/Nuevo');
    }

    public function store(Request $request)
    {
       
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        return Redirect::route('Familiars/Editar');
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
