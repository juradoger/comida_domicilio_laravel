@extends('layouts.plantilla')

@section('content')
<h1>Crear Cliente</h1>

<form action="{{ route('clientes.guardar') }}" method="POST">
    @csrf
    <input name="name" placeholder="Nombre" required>
    <input name="apellido" placeholder="Apellido" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <input name="telefono" placeholder="Teléfono">
    <button type="submit">Guardar</button>
</form>
@endsection
