@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Agregar Nuevo Depósito</h2>

        <form action="{{ route('deposits.store') }}" method="POST">
            @csrf

            <!-- Selector de Factura -->
            <div class="mb-3">
                <label for="bill_id" class="form-label">Factura</label>
                <select class="form-control" id="bill_id" name="bill_id" required>
                    <option value="">Seleccione una factura</option>
                    @foreach($bills as $bill)
                        <option value="{{ $bill->id }}">{{ $bill->n_factura }} - {{ $bill->razon_social }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Número de Operación -->
            <div class="mb-3">
                <label for="n_operacion" class="form-label">Número de Operación</label>
                <input type="text" class="form-control" id="n_operacion" name="n_operacion" required>
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Monto -->
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Depósito</button>
            <a href="{{ route('deposits.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
