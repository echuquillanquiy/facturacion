<!-- resources/views/bills/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Factura</h2>
        <form action="{{ route('bills.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ruc" class="form-label">RUC</label>
                <input type="text" class="form-control @error('ruc') is-invalid @enderror" id="ruc" name="ruc" value="{{ old('ruc') }}">
                @error('ruc')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="razon_social" class="form-label">Razón Social</label>
                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social" name="razon_social" value="{{ old('razon_social') }}">
                @error('razon_social')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="n_factura" class="form-label">Número de Factura</label>
                <input type="text" class="form-control @error('n_factura') is-invalid @enderror" id="n_factura" name="n_factura" value="{{ old('n_factura') }}">
                @error('n_factura')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecha_emision" class="form-label">Fecha de Emisión</label>
                <input type="date" class="form-control @error('fecha_emision') is-invalid @enderror" id="fecha_emision" name="fecha_emision" value="{{ old('fecha_emision') }}">
                @error('fecha_emision')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="monto_total" class="form-label">Monto Total</label>
                <input type="number" step="0.01" class="form-control @error('monto_total') is-invalid @enderror" id="monto_total" name="monto_total" value="{{ old('monto_total') }}">
                @error('monto_total')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Factura</button>
        </form>
    </div>
@endsection
