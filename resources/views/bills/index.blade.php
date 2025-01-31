<!-- resources/views/bills/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Lista de Facturas</h2>

        <!-- Mostrar mensaje de éxito si existe -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón para crear una nueva factura -->
        <a href="{{ route('bills.create') }}" class="btn btn-success mb-3">Crear Factura</a>

        <!-- Tabla con las facturas -->
        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Número de Factura</th>
                <th>Fecha de Emisión</th>
                <th>Monto Total</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->ruc }}</td>
                    <td>{{ $bill->razon_social }}</td>
                    <td>{{ $bill->n_factura }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->fecha_emision)->format('d/m/Y') }}</td>
                    <td>S/. {{ number_format($bill->monto_total, 2) }}</td>
                    <td>
                        <!-- Botón para editar con ícono -->
                        <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>

                        <!-- Formulario para eliminar con ícono -->
                        <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta factura?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Borrar
                            </button>
                        </form>

                        <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-pencil-square"></i> Detalles
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
