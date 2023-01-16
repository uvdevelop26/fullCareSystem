<?php

use App\Http\Controllers\EgresoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FamiliareController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SueldoController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Login

/* Route::get('/', function () {
    return Inertia::render('Auth/Login');
}); */

//dashboard

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard/Index');
        })->name('dashboard');
    });

//Residentes
Route::resource('residentes', ResidenteController::class)
    ->middleware('auth:sanctum', 'verified');

//Familiares
Route::resource('familiares', FamiliareController::class)
    ->middleware('auth:sanctum', 'verified');
//Empleados
Route::resource('empleados', EmpleadoController::class)
    ->middleware('auth:sanctum', 'verified');

//Sueldos
Route::resource('sueldos', SueldoController::class)
    ->middleware('auth:sanctum', 'verified');

//Permisos
Route::resource('permisos', PermisoController::class)
    ->middleware('auth:sanctum', 'verified');

//Usuarios
Route::resource('usuarios', UserController::class)
    ->middleware('auth:sanctum', 'verified');

//Roles
Route::resource('roles', RoleController::class)
    ->middleware('auth:sanctum', 'verified');

//Premissions
Route::resource('permissions', PermissionController::class)
    ->middleware('auth:sanctum', 'verified');


//Ingresos
Route::resource('ingresos', IngresoController::class)
    ->middleware('auth:sanctum', 'verified');

//Egresos
Route::resource('egresos', EgresoController::class)
    ->middleware('auth:sanctum', 'verified');
