<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BalanceController extends Controller
{

    public function index()
    {
        return Inertia::render('Balance/Index');
    }

    public function obtenerMovimiento(Request $request)
    {
        if ($request->consulta == 'diario') {

            $ingresos = Ingreso::where('fecha', $request->fecha)
                ->select('concepto', 'fecha', 'monto as monto_ingreso')
                ->get();
            $egresos = Egreso::where('fecha', $request->fecha)
                ->select('concepto', 'fecha', 'monto as monto_egreso')
                ->get();

            $movimientosDiarios = $ingresos->concat($egresos);

            //calcular total de ingresos y egresos del día
            $totalIngresosDiarios = $ingresos->sum('monto_ingreso');

            $totalEgresosDiarios = $egresos->sum('monto_egreso');

            $movimientosDiarios[] = [
                'total_ingresos_diarios' => $totalIngresosDiarios,
                'total_egresos_diarios' => $totalEgresosDiarios
            ];

            return response()->json($movimientosDiarios);
        } else if ($request->consulta == 'mensual') {

            $ingresos = Ingreso::whereMonth('fecha', $request->mes)
                ->whereYear('fecha', $request->anho)
                ->select('concepto', 'fecha', 'monto as monto_ingreso')
                ->orderBy('fecha')
                ->get();

            $egresos = Egreso::whereMonth('fecha', $request->mes)
                ->whereYear('fecha', $request->anho)
                ->select('concepto', 'fecha', 'monto as monto_egreso')
                ->orderBy('fecha')
                ->get();

            $movimientosMensuales = $ingresos->concat($egresos);

            //calcular total de ingresos y egresos del mes

            $totalIngresosMensuales = $ingresos->sum('monto_ingreso');

            $totalEgresosMensuales = $egresos->sum('monto_egreso');

            $movimientosMensuales[] = [
                'total_ingresos_mensuales' => $totalIngresosMensuales,
                'total_egresos_mensuales' => $totalEgresosMensuales
            ];

            return response()->json($movimientosMensuales);
        }
    }


    public function diariopdf($fecha)
    {
        //movimientos del día
        $ingresos = Ingreso::where('fecha', $fecha)
            ->select('concepto', 'fecha', 'monto as monto_ingreso')
            ->get();
        $egresos = Egreso::where('fecha', $fecha)
            ->select('concepto', 'fecha', 'monto as monto_egreso')
            ->get();

        $movimientosDiarios = $ingresos->concat($egresos);

        //calculo de subtotales
        $totalIngresosDiarios = $ingresos->sum('monto_ingreso');

        $totalEgresosDiarios = $egresos->sum('monto_egreso');

        $diferencia = $totalIngresosDiarios - $totalEgresosDiarios;

        //conversión a pdf

        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('movimientoDiario', compact('movimientosDiarios', 'fecha', 'totalIngresosDiarios', 'totalEgresosDiarios', 'diferencia'));

        return $pdf->stream();
    }


    public function mensualpdf($mes, $anho)
    {
        $ingresos = Ingreso::whereMonth('fecha', $mes)
            ->whereYear('fecha', $anho)
            ->select('concepto', 'fecha', 'monto as monto_ingreso')
            ->orderBy('fecha')
            ->get();

        $egresos = Egreso::whereMonth('fecha', $mes)
            ->whereYear('fecha', $anho)
            ->select('concepto', 'fecha', 'monto as monto_egreso')
            ->orderBy('fecha')
            ->get();

        $movimientosMensuales = $ingresos->concat($egresos);

        //calcular total de ingresos y egresos del mes

        $totalIngresosMensuales = $ingresos->sum('monto_ingreso');

        $totalEgresosMensuales = $egresos->sum('monto_egreso');

        $diferencia = $totalIngresosMensuales - $totalEgresosMensuales;

        //conversión a pdf
        $pdf = app('dompdf.wrapper');

        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf->loadView('movimientoMensual', compact('movimientosMensuales', 'mes', 'totalIngresosMensuales', 'totalEgresosMensuales', 'diferencia'));

        return $pdf->stream();
    }
}
