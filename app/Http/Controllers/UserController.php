<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{

    public function index()
    {

        return Inertia::render('Usuarios/Index', [
            'users' => User::with('empleado.persona')
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }


    public function create()
    {
        return Inertia::render('Usuarios/Nuevo');
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'empleado_id' => 'required'
        ]);

        User::create([
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'empleado_id' => $request['empleado_id']
        ]);

        return Redirect::route('usuarios.index')->with('success', 'Usuario Creado');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);
        $user = User::where('id', $id)->get();
        return Inertia::render(
            'Usuarios/Editar',
            [
                'user' => $user
            ]
        );
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'empleado_id' => 'required'
        ]);

        $user = User::find($id);

        $user->update([
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'empleado_id' => $request['empleado_id']
        ]);

        return Redirect::route('usuarios.index')->with('success', 'Usuario Actualizado.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user = User::where('id', $id);

        $user->delete();

        return Redirect::route('usuarios.index')->with('success', 'Usuario Eliminado');
    }
}
