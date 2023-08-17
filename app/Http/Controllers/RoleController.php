<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use PhpParser\Node\Stmt\Return_;

use \Illuminate\Auth\Middleware\Authorize;

class RoleController extends Controller
{

    public function index(Request $request)
    {
       
        $queries = ['search'];

        $roles = Role::with('permissions')
            ->orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'filters' => $request->all($queries),
        ]);
    }


    public function create()
    {
        $permissions = Permission::all();

        return Inertia::render('Roles/Nuevo', [
            'permissions' => $permissions
        ]);
    }


    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->input('name')
        ]);

        $role->syncPermissions($request->input('permissions'));

        return Redirect::route('roles.index')->with('success', 'Rol Creado');
    }



    public function edit(Role $role)
    {

        $permissions = Permission::all();
        //los permisos que tiene este rol en forma de array puro
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return Inertia::render('Roles/Editar', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions
        ]);
    }

    public function update(Request $request, $id)
    {

        $role = Role::find($id);

        $role->update([
            'name' => $request['name'],
        ]);

        $role->syncPermissions($request['permissions']);

        return Redirect::route('roles.index');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index');
    }

  /*   public function getRole()
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames();


        return Inertia::render('Layouts/LayoutApp', ['userRole' => $userRole]);
    } */
}
