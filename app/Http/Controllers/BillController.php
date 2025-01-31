<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::orderBy('n_factura', 'asc')->paginate(50); // Trae todas las facturas
        return view('bills.index', compact('bills')); // Pasa las facturas a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruc' => 'nullable|string|max:255',
            'razon_social' => 'nullable|string|max:255',
            'n_factura' => 'nullable|string|max:255',
            'fecha_emision' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'monto_total' => 'nullable|numeric',
        ]);

        Bill::create($request->all());

        return redirect()->route('bills.index')->with('success', 'Factura creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la factura por su ID
        $bill = Bill::findOrFail($id);

        // Obtener las detracciones y depósitos relacionados con la factura
        $detracciones = $bill->detracciones;
        $deposits = $bill->deposits;

        // Calcular el total de depósitos
        $totalDeposits = $deposits->sum('monto');

        // Calcular el monto restante para igualar la factura
        $amountRemaining = $bill->monto_total - $totalDeposits;

        // Pasar los datos a la vista
        return view('bills.show', compact('bill', 'detracciones', 'deposits', 'totalDeposits', 'amountRemaining'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Buscar la factura por su ID
        $bill = Bill::findOrFail($id);

        // Convertir la fecha de emisión a un formato adecuado (si es un string)
        $bill->fecha_emision = \Carbon\Carbon::parse($bill->fecha_emision)->toDateString();

        // Retornar la vista de edición con la factura encontrada
        return view('bills.edit', compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'ruc' => 'nullable|string|max:20',
            'razon_social' => 'nullable|string|max:255',
            'n_factura' => 'nullable|string|max:50',
            'fecha_emision' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'monto_total' => 'nullable|numeric',
        ]);

        // Buscar la factura por su ID
        $bill = Bill::findOrFail($id);

        // Actualizar la factura con los datos validados
        $bill->update($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('bills.index')->with('success', 'Factura actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
