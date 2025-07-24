@extends('Layouts.plantilla')

@section('title', 'Login')
@section('header', 'Iniciar Sesión')

@section('content')
    <h2 class="text-xl font-bold mb-4">Login</h2>
    @if(session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <ul class="text-red-600">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Correo" required class="border rounded px-3 py-2 w-full"><br>
        <input type="password" name="password" placeholder="Contraseña" required class="border rounded px-3 py-2 w-full"><br>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ingresar</button>
    </form>
@endsection
