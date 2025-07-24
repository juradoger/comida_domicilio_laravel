@extends('layouts.plantilla')

@section('content')
<h1>Lista de Clientes</h1>
<a href="{{ route('clientes.crear') }}">Crear Cliente</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->name }}</td>
            <td>{{ $cliente->apellido }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>
                <a href="{{ route('clientes.editar', $cliente) }}">Editar</a>
                <form action="{{ route('clientes.eliminar', $cliente) }}" method="POST" style="display:inline;">
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
