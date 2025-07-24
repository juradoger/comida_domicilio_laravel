@extends('layouts.plantilla')

@section('content')
    <h1>Editar Empleado</h1>

    @if ($errors->any())
        <div>
            <strong>Errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.actualizar', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Datos del usuario --}}
        <h3>Datos Personales</h3>
        <label>Nombre:</label>
        <input type="text" name="name" value="{{ $empleado->usuario ? $empleado->usuario->name : '' }}"><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="{{ $empleado->usuario ? $empleado->usuario->apellido : '' }}"><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $empleado->usuario ? $empleado->usuario->email : '' }}"><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ $empleado->usuario ? $empleado->usuario->telefono : '' }}"><br>

        {{-- Datos del empleado --}}
        <h3>Datos Laborales</h3>
        <label>Fecha Ingreso:</label>
        <input type="date" name="fecha_ingreso" value="{{ $empleado->fecha_ingreso }}"><br>

        <label>Estado:</label>
        <input type="text" name="estado" value="{{ $empleado->estado }}"><br>

        <label>Cargo:</label>
        <input type="text" name="cargo" value="{{ $empleado->cargo }}"><br>

        <button type="submit">Actualizar</button>
    </form>
@endsection
