@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de la Factura: {{ $bill->n_factura }}</h2>

        <!-- Mostrar información de la factura -->
        <p><strong>Razón Social:</strong> {{ $bill->razon_social }}</p>
        <h1><strong>Monto Total:</strong> {{ number_format($bill->monto_total, 2) }}</h1>

        <hr>

        <!-- Mostrar Detalles de Detracciones -->
        <h2 class="alert alert-info">Detracciones</h2>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Factura</th>
                <th>Fecha de Emisión</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detracciones as $detraccion)
                <tr>
                    <td>{{ $detraccion->bill->n_factura }}</td>
                    <td>{{ \Carbon\Carbon::parse($detraccion->f_emision)->format('d-m-Y') }}</td>
                    <td>{{ number_format($detraccion->monto, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Mostrar Detalles de Depósitos -->
        <h2 class="alert alert-info">Depósitos</h2>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Factura</th>
                <th>Número de Operación</th>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deposits as $deposit)
                <tr>
                    <td>{{ $deposit->bill->n_factura }}</td>
                    <td>{{ $deposit->n_operacion }}</td>
                    <td>{{ \Carbon\Carbon::parse($deposit->fecha)->format('d-m-Y') }}</td>
                    <td>{{ number_format($deposit->monto, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Mostrar el cálculo del monto restante -->
        <div class="alert alert-primary">
            <strong>Monto Total de la Factura:</strong> {{ number_format($bill->monto_total, 2) }}<br>
            <strong>Total de Depósitos Realizados:</strong> {{ number_format($totalDeposits, 2) }}<br>
            <strong>Monto que falta para cancelar la factura:</strong> {{ number_format($amountRemaining, 2) }}
        </div>
        <!-- Botón para volver al índice -->
        <a href="{{ route('bills.index') }}" class="btn btn-secondary mt-4">Volver al Índice</a>

    </div>
@endsection
