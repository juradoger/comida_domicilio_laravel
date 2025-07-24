@extends('layouts.empleado')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Lista de Clientes</h1>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nombre</th>
                <th class="py-2 px-4 border-b">Apellido</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $cliente->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $cliente->apellido }}</td>
                    <td class="py-2 px-4 border-b">{{ $cliente->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $cliente->telefono }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 