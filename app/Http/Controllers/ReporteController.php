<?php

namespace App\Http\Controllers;

use App\Models\ControlMedicamento;
use App\Models\ControlRutina;
use App\Models\Empleado;
use App\Models\EstadoResidente;
use App\Models\Jornada;
use App\Models\Medicamento;
use App\Models\Residente;
use App\Models\Rutina;
use App\Models\Sueldo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $residentes = Residente::with('persona.ciudade', 'habitacione')
            ->orderBy('id', 'desc')
            ->get();

        $cantidadResidentes = Residente::count();

        $cantidadFemenino = Residente::whereHas('persona', function ($query) {
            $query->where('sexo', 'femenino');
        })->count();

        $cantidadMasculino = Residente::whereHas('persona', function ($query) {
            $query->where('sexo', 'masculino');
        })->count();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('residentes', compact('residentes', 'cantidadResidentes', 'fechaActual', 'users', 'cantidadFemenino', 'cantidadMasculino'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function estadospdf()
    {
        $ultimoEstado = null;

        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $estados = EstadoResidente::with('residente.persona')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('estado_residentes')
                    ->groupBy('residente_id');
            })
            ->get();

        $activos = $estados->filter(function ($estado) {
            return $estado->nombre === 1;
        })->count();

        $inactivos = $estados->filter(function ($estado) {
            return $estado->nombre === 0;
        })->count();



        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('estados', compact('estados', 'fechaActual', 'users', 'activos', 'inactivos'));

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

        $cantidadEnfermeros = Empleado::whereHas('seccion', function ($query) {
            $query->where('nombre_seccion', 'enfermeria');
        })->count();

        $cantidadAdministrador = Empleado::whereHas('seccion', function ($query) {
            $query->where('nombre_seccion', 'administracion');
        })->count();

        $cantidadStaff = Empleado::whereHas('seccion', function ($query) {
            $query->where('nombre_seccion', 'staff');
        })->count();


        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('empleados', compact('empleados', 'cantidadEmpleados', 'fechaActual', 'users', 'cantidadEnfermeros', 'cantidadAdministrador', 'cantidadStaff'));

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

        $suministrados = Medicamento::has('horarioMedicamentos')->count();

        $noSuministrados = Medicamento::doesntHave('horarioMedicamentos')->count();

        $totalMedicamentos = Medicamento::count();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('medicamentos', compact('medicamentos', 'fechaActual', 'users', 'suministrados', 'noSuministrados', 'totalMedicamentos'));

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
        app()->setLocale('es');

        $nombreMes = Carbon::create(null, $mes, 1)->monthName;

        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();


        $sueldos = Sueldo::with('empleado.persona', 'empleado.seccion')
            ->whereYear('fecha', $anho)
            ->whereMonth('fecha', $mes)
            ->get();

        $totalSueldos = Sueldo::whereYear('fecha', $anho)
            ->whereMonth('fecha', $mes)
            ->sum('monto');

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('sueldos', compact('sueldos', 'mes', 'nombreMes', 'fechaActual', 'users', 'totalSueldos'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    public function controlMedicamentospdf($fecha)
    {

        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $controlMedicamentos = ControlMedicamento::with('user', 'horarioMedicamento.medicamentos.residente.persona')
            ->where('fecha', $fecha)
            ->orderBy('id', 'desc')
            ->get();

        //generar pdf
        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('controlMedicamento', compact('fechaActual', 'users', 'controlMedicamentos', 'fecha'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function controlRutinaspdf($fecha)
    {
        $fechaActual = Carbon::today()->toDateString();

        $users = Auth::user();

        $controlRutinas = ControlRutina::with('user', 'horarioRutina.rutinas.residente.persona')
            ->where('fecha', $fecha)
            ->orderBy('id', 'desc')
            ->get();

        //generar pdf
        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('controlRutina', compact('fechaActual', 'users', 'controlRutinas', 'fecha'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }
}
