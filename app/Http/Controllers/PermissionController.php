<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\User;
//use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


use PhpParser\Node\Stmt\Return_;


use \Illuminate\Auth\Middleware\Authorize;

class PermissionController extends Controller
{
    
    public function index()
    {

        $permissions = Permission::orderBy('id', 'desc')->paginate(8);
        return Inertia::render('Permissions/Index',[
                'permissions' => $permissions,

            ]);
    }


    public function create()
    {
        return Inertia::render('Permissions/Nuevo');
    }


    public function store(Request $request)
    {
        Permission::create($request->all());

        return Redirect::route('permissions.index')->with('success', 'Permisco Creado');
    }


    public function show($id)
    {
        //
    }


    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/Editar', [
            'permission' => $permission
        ]);
    }


    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());

        return Redirect::route('permissions.index')->with('success', 'Permiso Actualizado');
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();

        return Redirect::route('permissions.index')->with('success', 'Permiso Eliminado');
    }
}
