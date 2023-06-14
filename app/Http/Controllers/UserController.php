<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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

    public function index(Request $request)
    {

        $queries = ['search', 'search_rol'];

        $users = User::with('empleado.persona', 'roles')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        $roles = Role::all();

        return Inertia::render('Usuarios/Index', [
            'users' => $users,
            'filters' => $request->all($queries),
            'roles' => $roles
        ]);
    }


    public function create()
    {
        $roles = Role::all();

        return Inertia::render('Usuarios/Nuevo', [
            'roles' => $roles
        ]);
    }


    public function store(UserRequest $request)
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role_id'));


        return Redirect::route('usuarios.index');
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


    public function update(UserRequest $request, $id)
    {
        
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



        return Redirect::route('usuarios.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return Redirect::route('usuarios.index');
    }
}
