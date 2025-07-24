@extends('layouts.empleado')

@section('content')
    <h1>Lista de Empleados</h1>
    <a href="{{ route('empleados.crear') }}">Crear Empleado</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Fecha Ingreso</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->usuario ? $empleado->usuario->name : 'Sin usuario' }}</td>
                    <td>{{ $empleado->usuario ? $empleado->usuario->apellido : '' }}</td>
                    <td>{{ $empleado->usuario ? $empleado->usuario->email : '' }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->fecha_ingreso }}</td>
                    <td>{{ $empleado->estado }}</td>
                    <td>
                        <a href="{{ route('empleados.editar', $empleado->id) }}">Editar</a>
                        <form action="{{ route('empleados.eliminar', $empleado->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
