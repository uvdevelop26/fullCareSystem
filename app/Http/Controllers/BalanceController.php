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
                ->select('concepto', 'monto as monto_ingreso')
                ->get();

            $egresos = Egreso::whereMonth('fecha', $request->mes)
                ->whereYear('fecha', $request->anho)
                ->select('concepto', 'monto as monto_egreso')
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




    /*  public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    } */
}
