<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Jornada;
use App\Models\Medicamento;
use App\Models\Residente;
use App\Models\Rutina;
use App\Models\User;
use Illuminate\Http\Request;
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

        $pdf->loadView('residentes', compact('residentes', 'cantidadResidentes', 'cantidadActivos', 'cantidadInactivos'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function empleadospdf()
    {
        $empleados = Empleado::with('persona.ciudade', 'seccion')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('empleados', compact('empleados'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function jornadaspdf()
    {
        $jornadas = Jornada::has('dias')
            ->with('dias', 'empleado.persona', 'turno')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('jornadas', compact('jornadas'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function usuariospdf()
    {
        $usuarios = User::with('empleado.persona', 'roles')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('usuarios', compact('usuarios'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function medicamentospdf()
    {
        $medicamentos = Medicamento::with('residente.persona', 'presentacione', 'horarioMedicamentos')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('medicamentos', compact('medicamentos'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function rutinaspdf()
    {
        $rutinas = Rutina::with('residente.persona', 'horarioRutinas')
            ->orderBy('id', 'desc')
            ->get();

        //genera pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('rutinas', compact('rutinas'));

        return $pdf->setPaper('a4', 'landscape')->stream();
    }
}
