<!-- resources/views/detracciones/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Detracciones</h2>

        <!-- Botón para crear un nuevo depósito -->
        <a href="{{ route('detractions.create') }}" class="btn btn-success mb-4">
            Crear Detracción
        </a>

        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Factura</th>
                <th>Fecha de Emisión</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detracciones as $detraccion)
                <tr>
                    <td>{{ $detraccion->bill->n_factura }}</td>
                    <td>
                        @if($detraccion->f_emision)
                            {{ \Carbon\Carbon::parse($detraccion->f_emision)->toDateString() }}
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>S/. {{ number_format($detraccion->monto, 2) }}</td>
                    <td>
                        <a href="{{ route('detractions.edit', $detraccion->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('detractions.destroy', $detraccion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $detracciones->links() }}
    </div>
@endsection
