<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Deposit;
use App\Models\Detraction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Buscar todas las facturas con sus detracciones y depósitos relacionados
        $bills = Bill::with('detracciones', 'deposits')->get();

        // Si se ha seleccionado una factura
        if ($request->has('bill_id')) {
            $bill = Bill::find($request->bill_id);

            if (!$bill) {
                return back()->with('error', 'Factura no encontrada');
            }

            // Obtener las detracciones y depósitos relacionados
            $detracciones = $bill->detracciones;
            $deposits = $bill->deposits;

            // Calcular el total de depósitos (si existen)
            $totalDeposits = $deposits->isEmpty() ? 0 : $deposits->sum('monto');

            // Calcular el monto que falta para igualar la factura
            $amountRemaining = $bill->monto_total - $totalDeposits;

            return view('home', compact('bills', 'bill', 'detracciones', 'deposits', 'totalDeposits', 'amountRemaining'));
        }

        // Si no se ha seleccionado ninguna factura
        return view('bills.index', compact('bills'));
    }

}
