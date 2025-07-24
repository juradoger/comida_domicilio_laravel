@extends('layouts.plantilla')

@section('content')
    <h1>Crear Pedido</h1>

    <form action="{{ route('pedidos.guardar') }}" method="POST">
        @csrf
    
        <label for="id_usuario">Cliente:</label>
        <select name="id_usuario" required>
            <option value="">Seleccione un cliente</option>
            @foreach($usuarios as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->name }} {{ $cliente->apellido }}</option>
            @endforeach
        </select>
    
        <label>Empleado</label>
<select name="id_empleado" required>
    <option value="">Seleccione un empleado</option>
    @foreach($empleados as $empleado)
        <option value="{{ $empleado->id }}">
            {{ $empleado->usuario->name }} {{ $empleado->usuario->apellido }}
        </option>
    @endforeach
</select>

    
        <!-- Otros campos: total, fecha_entrega, direccion, estado -->
        <input type="text" name="total" placeholder="Total">
        <input type="date" name="fecha_entrega">
        <input type="text" name="direccion" placeholder="Dirección">
        <label for="estado">Estado:</label>
        <select name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="en_camino">En camino</option>
            <option value="entregado">Entregado</option>
        </select>
        
        <button type="submit">Guardar Pedido</button>
    </form>
    
@endsection
