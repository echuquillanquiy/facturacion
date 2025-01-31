<!-- resources/views/detracciones/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Agregar Nueva Detracción</h2>

        <form action="{{ route('detractions.store') }}" method="POST">
            @csrf

            <!-- Selector de Factura -->
            <div class="mb-3">
                <label for="bill_id" class="form-label">Factura</label>
                <select class="form-control" id="bill_id" name="bill_id" required>
                    @foreach($bills as $bill)
                        <option value="{{ $bill->id }}">{{ $bill->n_factura }} - {{ $bill->razon_social }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de Emisión -->
            <div class="mb-3">
                <label for="f_emision" class="form-label">Fecha de Emisión</label>
                <input type="date" class="form-control" id="f_emision" name="f_emision" required>
            </div>

            <!-- Monto -->
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Detracción</button>
            <a href="{{ route('detractions.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
