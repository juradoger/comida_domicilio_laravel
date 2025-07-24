@extends('layouts.empleado')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Lista de Empleados/Repartidores</h1>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nombre</th>
                <th class="py-2 px-4 border-b">Apellido</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Teléfono</th>
                <th class="py-2 px-4 border-b">Cargo</th>
                <th class="py-2 px-4 border-b">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $empleado->usuario->name ?? '' }}</td>
                    <td class="py-2 px-4 border-b">{{ $empleado->usuario->apellido ?? '' }}</td>
                    <td class="py-2 px-4 border-b">{{ $empleado->usuario->email ?? '' }}</td>
                    <td class="py-2 px-4 border-b">{{ $empleado->usuario->telefono ?? '' }}</td>
                    <td class="py-2 px-4 border-b">{{ $empleado->cargo }}</td>
                    <td class="py-2 px-4 border-b">{{ $empleado->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 