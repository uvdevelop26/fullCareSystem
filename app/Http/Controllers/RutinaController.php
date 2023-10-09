<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RutinaController extends Controller
{

    public function index()
    {
        $rutinas = Rutina::with('residente.persona', 'horarios')
            ->orderBy('id', 'desc')
            ->get();
        
        return Inertia::render('Rutinas/Index', [
            'rutinas' => $rutinas
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


    public function destroy($id)
    {
        //
    }
}
