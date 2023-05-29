<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
//use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;

    public function index()
    {


        return Inertia::render('Usuarios/Index', [
            'users' => User::with('empleado.persona', 'roles')
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }


    public function create()
    {
        $roles = Role::all();

        return Inertia::render('Usuarios/Nuevo', [
            'roles' => $roles
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'empleado_id' => 'required',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role_id'));



        return Redirect::route('usuarios.index')->with('success', 'Usuario Creado');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->all();

        return Inertia::render(
            'Usuarios/Editar',
            [
                'user' => $user,
                'roles' => $roles,
                'userRole' => $userRole
            ]
        );
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'empleado_id' => 'required',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('role_id'));



        return Redirect::route('usuarios.index')->with('success', 'Usuario Actualizado.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        //  $user = User::where('id', $id);

        $user->delete();

        return Redirect::route('usuarios.index')->with('success', 'Usuario Eliminado');
    }
}
