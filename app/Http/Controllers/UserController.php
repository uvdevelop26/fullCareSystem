<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Empleado;
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
        $seccionesExcluidas = ['staff'];

        $empleados = Empleado::with('persona')->whereHas('seccion', function ($query) use ($seccionesExcluidas) {
            $query->whereNotIn('nombre_seccion', $seccionesExcluidas);
        })->get();
       // $empleados = Empleado::with('persona')->get();

        $roles = Role::all();

        return Inertia::render('Usuarios/Nuevo', [
            'roles' => $roles,
            'empleados' => $empleados
        ]);
    }


    public function store(UserRequest $request)
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role_id'));


        return Redirect::route('usuarios.index')->with('success', 'Usuario Guardado Exitosamente');
    }



    public function edit($id)
    {

        $seccionesExcluidas = ['staff'];

        $empleados = Empleado::with('persona')->whereHas('seccion', function ($query) use ($seccionesExcluidas) {
            $query->whereNotIn('nombre_seccion', $seccionesExcluidas);
        })->get();

        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->all();

       // $empleados = Empleado::with('persona')->get();

        return Inertia::render(
            'Usuarios/Editar',
            [
                'user' => $user,
                'roles' => $roles,
                'userRole' => $userRole,
                'empleados' => $empleados
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



        return Redirect::route('usuarios.index')->with('success', 'Usuario Editado Exitosamente');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return Redirect::route('usuarios.index')->with('success', 'Usuario Eliminado Exitosamente');
    }
}
