@extends('Layouts.empleado')

@section('title', 'Panel de Empleados')

@section('content')
<div class="fade-in-up">
    <!-- Header con bienvenida personalizada -->
    <div class="glass-card mb-8 p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[var(--color-primario)] to-[var(--color-secundario)] opacity-10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10">
            <h1 class="font-heading text-3xl md:text-4xl font-bold mb-2 text-[var(--color-primario)]">Bienvenido al Panel de Empleados</h1>
            <p class="font-sans text-gray-600 mb-4">Gestiona los pedidos y operaciones diarias</p>
        </div>
    </div>

    <!-- Tarjeta de bienvenida con perfil -->
    <div class="glass-card p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-[var(--color-primario)] text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold">
                    E
                </div>
                <div>
                    <h2 class="text-lg font-medium">Welcome</h2>
                    <p class="text-gray-600">Empleado</p>
                </div>
            </div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-outline flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Sign out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Pedidos Pendientes -->
        <div class="glass-card p-6 hover:shadow-lg transition-all">
            <h3 class="text-lg font-medium mb-2">Pedidos Pendientes</h3>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-bold">1</p>
                <span class="text-amber-500 bg-amber-100 px-2 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pedidos por procesar
                </span>
            </div>
        </div>

        <!-- En Preparación -->
        <div class="glass-card p-6 hover:shadow-lg transition-all">
            <h3 class="text-lg font-medium mb-2">En Preparación</h3>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-bold">0</p>
                <span class="text-blue-500 bg-blue-100 px-2 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                    Pedidos siendo preparados
                </span>
            </div>
        </div>

        <!-- En Camino -->
        <div class="glass-card p-6 hover:shadow-lg transition-all">
            <h3 class="text-lg font-medium mb-2">En Camino</h3>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-bold">0</p>
                <span class="text-indigo-500 bg-indigo-100 px-2 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Pedidos en ruta de entrega
                </span>
            </div>
        </div>

        <!-- Entregados Hoy -->
        <div class="glass-card p-6 hover:shadow-lg transition-all">
            <h3 class="text-lg font-medium mb-2">Entregados Hoy</h3>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-bold">0</p>
                <span class="text-green-500 bg-green-100 px-2 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Completados hoy
                </span>
            </div>
        </div>
    </div>

    <!-- Acciones rápidas -->
    <div class="glass-card p-6 mb-8">
        <h3 class="text-lg font-medium mb-4">Acciones Rápidas</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('empleado.clientes') }}" class="btn-action flex items-center gap-3 p-4 rounded-lg hover:shadow-md transition-all">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Ver Clientes</span>
            </a>
            <a href="{{ route('empleado.repartos.index') }}" class="btn-action flex items-center gap-3 p-4 rounded-lg hover:shadow-md transition-all">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Gestionar Repartos</span>
            </a>
            <a href="{{ route('empleado.repartidores') }}" class="btn-action flex items-center gap-3 p-4 rounded-lg hover:shadow-md transition-all">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                </svg>
                <span>Ver Repartidores</span>
            </a>
            <a href="{{ route('empleado.notificaciones.index') }}" class="btn-action flex items-center gap-3 p-4 rounded-lg hover:shadow-md transition-all">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span>Notificaciones</span>
            </a>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .btn-outline {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background: white;
        color: var(--color-texto);
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline:hover {
        background: rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }
    
    .btn-action {
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        border-color: rgba(0, 0, 0, 0.1);
    }
    
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
