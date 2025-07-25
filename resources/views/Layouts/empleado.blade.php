<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Panel Empleado - FastBite')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
            font-family: var(--font-sans);
        }

        /* Header moderno con glassmorphism */
        .header-glass {
            background: rgba(42, 157, 143, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(42, 157, 143, 0.3);
        }

        /* Logo animado */
        .logo-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-container:hover {
            transform: scale(1.05) rotate(-2deg);
            filter: drop-shadow(0 8px 16px rgba(244, 162, 97, 0.4));
        }

        /* Navegación elegante */
        .nav-link {
            position: relative;
            font-family: var(--font-sans);
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .nav-link.active {
            background: var(--color-acento);
            color: var(--color-texto);
            font-weight: 600;
        }

        /* Notificaciones modernas */
        .notification-btn {
            position: relative;
            padding: 0.75rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, #ff4757, #ff3838);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
            box-shadow: 0 2px 8px rgba(255, 71, 87, 0.4);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Dropdown moderno */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(42, 157, 143, 0.1);
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            color: var(--color-texto);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin: 0.25rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: var(--color-enfasis);
            color: white;
            transform: translateX(4px);
        }

        /* Notificación individual */
        .notification-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .notification-item:hover {
            background: rgba(42, 157, 143, 0.1);
        }

        .notification-item.unread {
            background: rgba(244, 162, 97, 0.05);
            border-left: 3px solid var(--color-acento);
        }

        /* Botón usuario elegante */
        .user-btn {
            background: linear-gradient(135deg, var(--color-enfasis) 0%, #238a7a 100%);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(42, 157, 143, 0.3);
            position: relative;
            overflow: hidden;
        }

        .user-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .user-btn:hover::before {
            left: 100%;
        }

        .user-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(42, 157, 143, 0.5);
        }

        /* Título principal con efecto */
        .main-title {
            font-family: var(--font-serif);
            background: linear-gradient(135deg, var(--color-enfasis) 0%, var(--color-primario) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-style: italic;
        }

        .subtitle {
            font-family: var(--font-cursive);
            color: rgba(255, 255, 255, 0.8);
            font-style: italic;
        }

        /* Alertas modernas */
        .alert {
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }

        .alert-success {
            background: rgba(42, 157, 143, 0.1);
            border-left: 4px solid var(--color-enfasis);
            color: var(--color-enfasis);
        }

        .alert-error {
            background: rgba(193, 39, 45, 0.1);
            border-left: 4px solid var(--color-primario);
            color: var(--color-primario);
        }

        /* Footer elegante */
        .footer-glass {
            background: linear-gradient(135deg, var(--color-enfasis) 0%, #238a7a 100%);
            position: relative;
            overflow: hidden;
        }

        .footer-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .footer-content {
            position: relative;
            z-index: 1;
        }

        /* Mobile menu */
        .mobile-menu {
            background: rgba(42, 157, 143, 0.98);
            backdrop-filter: blur(20px);
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-desktop {
                display: none;
            }
        }

        @media (min-width: 769px) {
            .nav-mobile {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">
    <!-- Header moderno -->
    <header class="header-glass sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo y título -->
                <div class="flex items-center gap-4">
                    <div class="logo-container">
                        <x-logo size="md" class="filter brightness-0 invert" />
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="main-title text-2xl lg:text-3xl">Panel Empleado</h1>
                        <p class="subtitle text-sm">Gestión operativa</p>
                    </div>
            </div>

                <!-- Navegación desktop -->
                <nav class="nav-desktop hidden lg:flex items-center gap-2">
                    <a href="{{ route('empleado.clientes') }}" class="nav-link {{ request()->routeIs('empleado.clientes') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Clientes
                    </a>
                    
                    <a href="{{ route('empleado.repartidores') }}" class="nav-link {{ request()->routeIs('empleado.repartidores') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Repartidores
                    </a>
                    
                    <a href="{{ route('empleado.repartos.index') }}" class="nav-link {{ request()->routeIs('empleado.repartos.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"/>
                        </svg>
                        Repartos
                    </a>
                    
                    <a href="{{ route('productos.index') }}" class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                        Productos
                    </a>
                </nav>

                <!-- Notificaciones y usuario -->
                <div class="flex items-center gap-4">
                    @auth
                        <!-- Notificaciones -->
                        <div class="dropdown relative">
                            <button class="notification-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if(Auth::user()->notificacionesNoLeidas()->count() > 0)
                                    <span class="notification-badge">{{ Auth::user()->notificacionesNoLeidas()->count() }}</span>
                                @endif
                    </button>
                            <div class="dropdown-menu absolute right-0 mt-2 w-80">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h3 class="font-heading text-lg font-semibold text-gray-800">Notificaciones</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    @if (Auth::user()->notificaciones()->count() > 0)
                                        @foreach (Auth::user()->notificaciones()->latest()->take(5)->get() as $notificacion)
                                            <div class="notification-item {{ !$notificacion->leida ? 'unread' : '' }}">
                                                <p class="text-sm text-gray-800 font-medium">{{ $notificacion->mensaje }}</p>
                                                <p class="text-xs text-gray-500 mt-1">{{ $notificacion->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                                        <div class="p-3 border-t border-gray-200">
                                            <a href="{{ route('empleado.notificaciones.index') }}" class="block text-center text-sm font-medium" style="color: var(--color-enfasis);">
                                                Ver todas las notificaciones
                                            </a>
                                        </div>
                        @else
                                        <div class="p-8 text-center text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            </svg>
                                            <p class="text-sm">No tienes notificaciones</p>
                            </div>
                        @endif
                    </div>
                </div>
                        </div>

                        <!-- Usuario dropdown -->
                        <div class="dropdown relative">
                            <button class="user-btn flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="hidden sm:inline">{{ Auth::user()->nombre ?? Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 py-2">
                                <a href="{{ route('logout') }}" class="dropdown-item block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                        <a href="{{ route('login') }}" class="user-btn">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Iniciar Sesión
                        </a>
                @endauth

                    <!-- Botón menú móvil -->
                    <button id="mobile-menu-btn" class="lg:hidden nav-link">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="mobile-menu fixed inset-y-0 left-0 z-50 w-64 lg:hidden">
        <div class="flex flex-col h-full p-6">
            <div class="flex items-center justify-between mb-8">
                <x-logo size="sm" class="filter brightness-0 invert" />
                <button id="close-mobile-menu" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <nav class="flex flex-col gap-2">
                <a href="{{ route('empleado.clientes') }}" class="nav-link">Clientes</a>
                <a href="{{ route('empleado.repartidores') }}" class="nav-link">Repartidores</a>
                <a href="{{ route('empleado.repartos.index') }}" class="nav-link">Repartos</a>
                <a href="{{ route('productos.index') }}" class="nav-link">Productos</a>
            </nav>
        </div>
    </div>

    <!-- Overlay para menú móvil -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Contenido principal -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <!-- Alertas modernas -->
        @if (session('success'))
            <div class="alert alert-success">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer elegante -->
    <footer class="footer-glass text-white mt-16">
        <div class="footer-content">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Información principal -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-4 mb-4">
                            <x-logo size="md" class="filter brightness-0 invert" />
                            <div>
                                <h3 class="font-heading text-2xl font-bold">Panel Empleado</h3>
                                <p class="font-cursive text-sm opacity-80 italic">FastBite Operations</p>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">
                            Herramientas especializadas para la gestión operativa del restaurante. 
                            Administra clientes, coordina repartos y supervisa productos eficientemente.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div>
                        <h4 class="font-heading text-lg font-semibold mb-4">Gestión</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('empleado.clientes') }}" class="text-white/80 hover:text-white transition-colors">Clientes</a></li>
                            <li><a href="{{ route('empleado.repartidores') }}" class="text-white/80 hover:text-white transition-colors">Repartidores</a></li>
                            <li><a href="{{ route('empleado.repartos.index') }}" class="text-white/80 hover:text-white transition-colors">Repartos</a></li>
                            <li><a href="{{ route('productos.index') }}" class="text-white/80 hover:text-white transition-colors">Productos</a></li>
                        </ul>
                    </div>

                    <!-- Soporte -->
                    <div>
                        <h4 class="font-heading text-lg font-semibold mb-4">Soporte</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Manual Empleado</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Soporte Técnico</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Reportar Problema</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Políticas</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/20 py-6">
                <div class="container mx-auto px-4 text-center">
                    <p class="text-white/70">
                        &copy; {{ date('Y') }} <span class="font-cursive italic">FastBite</span> Panel Empleado. 
                        Todos los derechos reservados.
                    </p>
            </div>
            </div>
        </div>
    </footer>

    <!-- Scripts para menú móvil -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMobileMenu = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileOverlay = document.getElementById('mobile-overlay');

            function openMobileMenu() {
                mobileMenu.classList.add('open');
                mobileOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenuFunc() {
                mobileMenu.classList.remove('open');
                mobileOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileMenuBtn?.addEventListener('click', openMobileMenu);
            closeMobileMenu?.addEventListener('click', closeMobileMenuFunc);
            mobileOverlay?.addEventListener('click', closeMobileMenuFunc);

            // Cerrar menú al hacer clic en un enlace
            const mobileLinks = mobileMenu?.querySelectorAll('a');
            mobileLinks?.forEach(link => {
                link.addEventListener('click', closeMobileMenuFunc);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
