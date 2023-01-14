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
    function __construct()
    {
        $this->middleware('can:ver-permisos', ['only' => ['index', 'show']]);
        $this->middleware('can:crear-permisos', ['only' => ['create', 'store']]);
        $this->middleware('can:editar-permisos', ['only' => ['edit', 'update']]);
        $this->middleware('can:borrar-permisos', ['only' => ['destroy']]);
    }

    public function index()
    {

        $permissions = Permission::orderBy('id', 'desc')->get();
        return Inertia::render('Permissions/Index',[
                'permissions' => $permissions,
                'can' => [
                    'create' => Auth::user()->can('crear-permisos'),
                    'edit' => Auth::user()->can('editar-permisos'),
                    'delete' => Auth::user()->can('borrar-permisos'),
                ]

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

        return Redirect::route('permisos.index')->with('success', 'Permiso Eliminado');
    }
}
