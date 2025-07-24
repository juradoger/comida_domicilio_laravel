@extends('layouts.plantilla')

@section('content')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.actualizar', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Nombre</label>
            <input name="name" id="name" class="form-control" value="{{ old('name', $cliente->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido">Apellido</label>
            <input name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $cliente->apellido) }}" required>
        </div>

        <div class="mb-3">
            <label for="email">Correo</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono">Teléfono</label>
            <input name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
