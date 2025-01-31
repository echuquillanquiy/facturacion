<?php

// app/Http/Controllers/DetractionController.php
// app/Http/Controllers/DetraccionController.php
// app/Http/Controllers/DetraccionController.php
namespace App\Http\Controllers;

use App\Models\Detraccion;
use App\Models\Bill;
use App\Models\Detraction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetractionController extends Controller
{
    public function index()
    {
        // Obtener todas las detracciones con la relación de la factura
        $detracciones = Detraction::with('bill')->paginate(10); // Paginación de 10 por página

        return view('detractions.index', compact('detracciones'));
    }
    // Método para mostrar el formulario de creación de detracción
    public function create()
    {
        // Obtener todas las facturas para que el usuario pueda seleccionar una
        $bills = Bill::all();
        return view('detractions.create', compact('bills'));
    }

    // Método para guardar una nueva detracción
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'bill_id' => 'required|exists:bills,id', // La factura debe existir
            'f_emision' => 'nullable|date', // La fecha debe ser válida
            'monto' => 'nullable|numeric', // El monto debe ser numérico
        ]);

        // Verificar si 'f_emision' es una fecha válida y convertirla en un objeto Carbon
        if ($request->has('f_emision') && $request->f_emision) {
            // Convertir la fecha en formato 'Y-m-d' a un objeto Carbon
            $validated['f_emision'] = Carbon::parse($request->f_emision);
        }

        // Crear la nueva detracción con los datos validados
        Detraction::create($validated);

        // Redirigir a la lista de detracciones con un mensaje de éxito
        return redirect()->route('detractions.index')->with('success', 'Detracción guardada correctamente');
    }

    // Mostrar el formulario para editar una detracción existente
    public function edit($id)
    {
        // Obtener la detracción a editar
        $detraccion = Detraction::findOrFail($id);

        // Verificar que la fecha sea un objeto Carbon (si no lo es, convertirlo)
        if (is_string($detraccion->f_emision)) {
            $detraccion->f_emision = Carbon::parse($detraccion->f_emision);
        }

        // Obtener todas las facturas para el select
        $bills = Bill::all();

        // Pasar a la vista
        return view('detractions.edit', compact('detraccion', 'bills'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'bill_id' => 'required|exists:bills,id', // La factura debe existir
            'f_emision' => 'nullable|date', // La fecha debe ser válida
            'monto' => 'nullable|numeric', // El monto debe ser numérico
        ]);

        // Buscar la detracción que se va a actualizar
        $detraccion = Detraction::findOrFail($id);

        // Convertir 'f_emision' a un objeto Carbon si se proporciona
        if ($request->has('f_emision') && $request->f_emision) {
            $validated['f_emision'] = Carbon::parse($request->f_emision);
        }

        // Actualizar la detracción con los datos validados
        $detraccion->update($validated);

        // Redirigir a la lista de detracciones con un mensaje de éxito
        return redirect()->route('detractions.index')->with('success', 'Detracción actualizada correctamente');
    }

    public function destroy($id)
    {
        // Buscar la detracción por su ID y eliminarla
        $detraccion = Detraction::findOrFail($id);
        $detraccion->delete();

        // Redirigir a la lista de detracciones con un mensaje de éxito
        return redirect()->route('detractions.index')->with('success', 'Detracción eliminada correctamente');
    }
}
