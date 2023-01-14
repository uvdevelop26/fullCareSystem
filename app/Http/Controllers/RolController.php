<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RolController extends Controller
{
    //constructor para definir los roles
    function __construct()
    {
        $this->middleware('permission:ver-rol | crear-rol | editar-rol | borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::all();
        return Inertia::render('Roles/Index', ['roles' => $roles]);
    }


    public function create()
    {
        $permission = Permission::get();
        return Inertia::render('Roles/Nuevo', ['permission' => $permission]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return Redirect::route('Roles/Index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();

        $rolePermission = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return Inertia::render('Roles/Editar', [
            'role' => $role,
            'permission' => $permission,
            'rolePermission' => $rolePermission
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return Redirect::route('Roles/Index');
    }


    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();

        return Redirect::route('Roles/Index');
    }
}
