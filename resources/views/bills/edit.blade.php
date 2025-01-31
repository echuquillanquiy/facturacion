<!-- resources/views/bills/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Factura</h2>

        <!-- Formulario para editar factura -->
        <form action="{{ route('bills.update', $bill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ruc" class="form-label">RUC</label>
                <input type="text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc', $bill->ruc) }}" required>
                @error('ruc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="razon_social" class="form-label">Razón Social</label>
                <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social', $bill->razon_social) }}" required>
                @error('razon_social')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="n_factura" class="form-label">Número de Factura</label>
                <input type="text" class="form-control" id="n_factura" name="n_factura" value="{{ old('n_factura', $bill->n_factura) }}" required>
                @error('n_factura')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecha_emision" class="form-label">Fecha de Emisión</label>
                <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ \Carbon\Carbon::parse($bill->fecha_emision)->toDateString() }}" required>
                @error('fecha_emision')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $bill->descripcion) }}</textarea>
                @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="monto_total" class="form-label">Monto Total</label>
                <input type="number" class="form-control" id="monto_total" name="monto_total" value="{{ old('monto_total', $bill->monto_total) }}" step="0.01" required>
                @error('monto_total')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Factura</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
