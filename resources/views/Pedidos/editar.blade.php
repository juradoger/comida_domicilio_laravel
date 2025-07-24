@extends('layouts.plantilla')

@section('content')
    <h1>Editar Pedido</h1>

    <form action="{{ route('pedidos.actualizar', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="id_usuario">Cliente:</label>
        <select name="id_usuario" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $usuario->id == $pedido->id_usuario ? 'selected' : '' }}>
                    {{ $usuario->name }} ({{ $usuario->email }})
                </option>
            @endforeach
        </select>

        <label for="id_empleado">Empleado:</label>
        <select name="id_empleado">
            <option value="">Sin asignar</option>
            @foreach($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ $empleado->id == $pedido->id_empleado ? 'selected' : '' }}>
                    {{ $empleado->usuario->name ?? '' }} {{ $empleado->usuario->apellido ?? '' }}
                </option>
            @endforeach
        </select>

        <label for="total">Total:</label>
        <input type="number" step="0.01" name="total" value="{{ $pedido->total }}" required>

        <label for="fecha_entrega">Fecha de entrega:</label>
        <input type="datetime-local" name="fecha_entrega" value="{{ \Carbon\Carbon::parse($pedido->fecha_entrega)->format('Y-m-d\TH:i') }}" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="{{ $pedido->direccion }}" required>

        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en_camino" {{ $pedido->estado == 'en_camino' ? 'selected' : '' }}>En camino</option>
            <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
        </select>

        <button type="submit">Actualizar</button>
        <a href="{{ route('pedidos.index') }}">Cancelar</a>
    </form>
@endsection
