<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener los depósitos con paginación, puedes ajustarlo si necesitas más o menos registros por página
        $deposits = Deposit::with('bill')->paginate(10);  // Traemos la relación con 'bill' si es necesario

        // Pasar los depósitos a la vista
        return view('deposits.index', compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las facturas para pasarlas al formulario
        $bills = Bill::all();  // Ajusta según el nombre de tu modelo y la tabla que almacena las facturas

        // Retornar la vista con las facturas disponibles
        return view('deposits.create', compact('bills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'bill_id' => 'required|exists:bills,id', // Asegurarse de que la factura exista
            'n_operacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0', // Asegurarse de que el monto sea un valor numérico positivo
        ]);

        // Crear el nuevo depósito
        Deposit::create([
            'bill_id' => $request->bill_id,
            'n_operacion' => $request->n_operacion,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
        ]);

        // Redirigir a la lista de depósitos con un mensaje de éxito
        return redirect()->route('deposits.index')->with('success', 'Depósito creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener el depósito a editar por su ID
        $deposit = Deposit::findOrFail($id);
        // Obtener todas las facturas para pasarlas al formulario
        $bills = Bill::all();

        // Retornar la vista con los datos del depósito y las facturas
        return view('deposits.edit', compact('deposit', 'bills'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'bill_id' => 'required|exists:bills,id', // Asegurarse de que la factura exista
            'n_operacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0', // Asegurarse de que el monto sea un valor numérico positivo
        ]);

        // Obtener el depósito a actualizar
        $deposit = Deposit::findOrFail($id);

        // Actualizar los datos del depósito
        $deposit->update([
            'bill_id' => $request->bill_id,
            'n_operacion' => $request->n_operacion,
            'fecha' => $request->fecha,  // No es necesario convertir la fecha a Carbon aquí
            'monto' => $request->monto,
        ]);

        // Redirigir a la lista de depósitos con un mensaje de éxito
        return redirect()->route('deposits.index')->with('success', 'Depósito actualizado con éxito.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el depósito por su ID
        $deposit = Deposit::findOrFail($id);

        // Eliminar el depósito
        $deposit->delete();

        // Redirigir a la lista de depósitos con un mensaje de éxito
        return redirect()->route('deposits.index')->with('success', 'Depósito eliminado con éxito.');
    }

}
