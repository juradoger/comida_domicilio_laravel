@extends('Layouts.plantilla')

@section('title', 'Registro')
@section('header', 'Registro de Usuario')

@section('content')
    <h2 class="text-xl font-bold mb-4">Registro</h2>
    @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Nombre" required class="border rounded px-3 py-2 w-full"><br>
        <input type="text" name="apellido" placeholder="Apellido" required class="border rounded px-3 py-2 w-full"><br>
        <input type="email" name="email" placeholder="Correo" required class="border rounded px-3 py-2 w-full"><br>
        <input type="text" name="telefono" placeholder="Teléfono" required class="border rounded px-3 py-2 w-full"><br>
        <input type="password" name="password" placeholder="Contraseña" required class="border rounded px-3 py-2 w-full"><br>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required class="border rounded px-3 py-2 w-full"><br>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Registrar</button>
    </form>
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline block mt-4">¿Ya tienes cuenta? Inicia sesión</a>
@endsection
