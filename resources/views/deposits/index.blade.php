@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listado de Depósitos</h2>

        <!-- Botón para crear un nuevo depósito -->
        <a href="{{ route('deposits.create') }}" class="btn btn-success mb-4">
            Crear Depósito
        </a>

        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>N° Operación</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Factura Asociada</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deposits as $deposit)
                <tr>
                    <td>{{ $deposit->n_operacion }}</td>
                    <td>
                        @if($deposit->fecha)
                            {{ \Carbon\Carbon::parse($deposit->fecha)->format('d-m-Y') }}
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>S/. {{ number_format($deposit->monto, 2) }}</td>
                    <td>{{ $deposit->bill->n_factura ?? 'No relacionada' }}</td> <!-- Muestra el ID de la factura asociada -->
                    <td>
                        <a href="{{ route('deposits.edit', $deposit->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('deposits.destroy', $deposit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        {{ $deposits->links() }}
    </div>
@endsection
