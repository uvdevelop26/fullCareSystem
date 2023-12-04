<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Jornada;
use App\Models\Medicamento;
use App\Models\Residente;
use App\Models\Rutina;
use App\Models\Sueldo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReporteController extends Controller
{
    public function index()
    {
        $residentes = Residente::count();

        return Inertia::render('Reportes/Index', [
            'residentes' => $residentes
        ]);
    }

    public function residentespdf()
    {

        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();
        //datos
        $residentes = Residente::with('persona.ciudade', 'estado_residente')
            ->orderBy('id', 'desc')
            ->get();

        $cantidadResidentes = Residente::count();

        $cantidadActivos = Residente::whereHas('estado_residente', function ($query) {
            $query->where('nombre_estado', 'activo');
        })->count();

        $cantidadInactivos = Residente::whereHas('estado_residente', function ($query) {
            $query->where('nombre_estado', 'inactivo');
        })->count();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('residentes', compact('residentes', 'cantidadResidentes', 'cantidadActivos', 'cantidadInactivos', 'fechaActual', 'users'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function empleadospdf()
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $empleados = Empleado::with('persona.ciudade', 'seccion')
            ->orderBy('id', 'desc')
            ->get();

        $cantidadEmpleados = Empleado::count();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('empleados', compact('empleados', 'cantidadEmpleados', 'fechaActual', 'users'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function jornadaspdf()
    {

        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $jornadas = Jornada::has('dias')
            ->with('dias', 'empleado.persona', 'turno')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('jornadas', compact('jornadas', 'fechaActual', 'users'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function usuariospdf()
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $usuarios = User::with('empleado.persona', 'roles')
            ->orderBy('id', 'desc')
            ->get();

        $cantidadUsuarios = User::count();

        $cantidadEnfermeros = User::whereHas('roles', function ($query) {
            $query->where('name', 'enfermero');
        })->count();

        $cantidadAdmin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();


        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('usuarios', compact('usuarios', 'fechaActual', 'users', 'cantidadUsuarios', 'cantidadEnfermeros', 'cantidadAdmin'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function medicamentospdf()
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $medicamentos = Medicamento::with('residente.persona', 'presentacione', 'horarioMedicamentos')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('medicamentos', compact('medicamentos', 'fechaActual', 'users'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function rutinaspdf()
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $rutinas = Rutina::with('residente.persona', 'horarioRutinas')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('rutinas', compact('rutinas', 'fechaActual', 'users'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function sueldospdf($mes, $anho)
    {

        $sueldos = Sueldo::with('empleado.persona', 'empleado.seccion')
            ->whereYear('fecha', $anho)
            ->whereMonth('fecha', $mes)
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('sueldos', compact('sueldos', 'mes'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }
}
