@extends('layouts.plantilla')

@section('content')
    <h1>Lista de Pedidos</h1>
    <a href="{{ route('pedidos.crear') }}">Crear Pedido</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Empleado</th>
                <th>Total</th>
                <th>Fecha Entrega</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->usuario->name }}</td>
                    <td>{{ $pedido->empleado && $pedido->empleado->usuario ? $pedido->empleado->usuario->name . ' ' . $pedido->empleado->usuario->apellido : 'Sin asignar' }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ $pedido->fecha_entrega }}</td>
                    <td>{{ $pedido->direccion }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>
                        <a href="{{ route('pedidos.editar', $pedido->id) }}">Editar</a>
                        <form action="{{ route('pedidos.eliminar', $pedido->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este pedido?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
