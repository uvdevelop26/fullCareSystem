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

    public function index(Request $request)
    {
       

        $queries = ['search'];

        $permissions = Permission::orderBy('id', 'desc')
            ->filter($request->only($queries))
            ->get();
        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions,
            'filters' => $request->all($queries),
 
        ]);
    }


    public function create()
    {
        return Inertia::render('Permissions/Nuevo');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return Redirect::route('permissions.index');
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
        $request->validate([
            'name' => 'required'
        ]);

        $permission->update($request->all());

        return Redirect::route('permissions.index');
    }


    public function destroy($id)
    {
        $permission = Permission::find($id);
        
        $permission->delete();

        return Redirect::route('permissions.index');
    }
}
