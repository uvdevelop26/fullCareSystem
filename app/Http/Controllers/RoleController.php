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
    public function __construct()
    {
        $this->middleware('can:ver-rol', ['only' => ['index', 'show']]);
        $this->middleware('can:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('can:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('can:borrar-rol', ['only' => ['destroy']]);
    }


    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'can' => [
                'create' => Auth::user()->can('ver-rol'),
                'edit' => Auth::user()->can('editar-rol'),
                'delete' => Auth::user()->can('borrar-rol'),
            ]
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

        //si los permisos no están nulos se lo asignamos al rol creado
      /*   if (!empty($request->permissions)) {

            $role->givePermissionTo($request->permissions);
        } */

        return Redirect::route('roles.index')->with('success', 'Rol Creado');
    }


    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();
        //Este no se que hace
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

        return Inertia::render('Roles/Editar', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        //almacenamos en la variable permissions el array de permisos si es que tiene
        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        return Redirect::route('roles.index')->with('success', 'Rol Actualizado');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index')->with('success', 'Rol Eliminado');
    }
}
