<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Panel Administrador - FastBite')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <style>
        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
            font-family: var(--font-sans);
        }

        /* Header moderno con glassmorphism */
        .header-glass {
            background: rgba(193, 39, 45, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(193, 39, 45, 0.3);
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

        /* Dropdown moderno */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(193, 39, 45, 0.1);
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
            background: var(--color-acento);
            color: white;
            transform: translateX(4px);
        }

        /* Botón logout elegante */
        .logout-btn {
            background: linear-gradient(135deg, var(--color-acento) 0%, #e09145 100%);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(244, 162, 97, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(244, 162, 97, 0.5);
        }

        /* Título principal con efecto */
        .main-title {
            font-family: var(--font-serif);
            background: linear-gradient(135deg, var(--color-primario) 0%, var(--color-enfasis) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
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
            background: linear-gradient(135deg, var(--color-primario) 0%, var(--color-secundario) 100%);
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
            background: rgba(193, 39, 45, 0.98);
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
    <style>
        /* Animaciones */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
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
        
        .animation-delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }
        
        .animation-delay-500 {
            animation-delay: 0.5s;
            opacity: 0;
        }
        
        .animation-delay-700 {
            animation-delay: 0.7s;
            opacity: 0;
        }
        
        .animation-delay-900 {
            animation-delay: 0.9s;
            opacity: 0;
        }
        
        /* Tarjetas con glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        
        /* Tarjetas de estadísticas */
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .stat-card:hover::after {
            opacity: 1;
        }
        
        /* Botón con efecto shimmer */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        
        .btn-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.7s;
        }
        
        .btn-shimmer:hover::before {
            left: 100%;
        }
    </style>
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
                        <h1 class="main-title text-2xl lg:text-3xl">Panel Administrador</h1>
                        <p class="font-cursive text-sm text-white/70 italic">Gestión FastBite</p>
                    </div>
                </div>

                <!-- Navegación desktop -->
                <nav class="nav-desktop hidden lg:flex items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.pedidos.index') }}" class="nav-link {{ request()->routeIs('admin.pedidos.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Pedidos
                    </a>
                    
                    <a href="{{ route('admin.clientes.index') }}" class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Clientes
                    </a>
                    
                    <a href="{{ route('productos.index') }}" class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                        Productos
                    </a>

                    <!-- Dropdown Más opciones -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center gap-1">
                            Más
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-56 py-2">
                            <a href="{{ route('categorias.index') }}" class="dropdown-item block">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Categorías
                            </a>
                            <a href="{{ route('empleados.index') }}" class="dropdown-item block">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Empleados
                            </a>
                            <a href="{{ route('admin.pagos.index') }}" class="dropdown-item block">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Pagos
                            </a>
                            <a href="{{ route('admin.estadisticas') }}" class="dropdown-item block">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Estadísticas
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Botón logout y menú móvil -->
                <div class="flex items-center gap-4">
                    @auth
                        <button onclick="document.getElementById('logout-form').submit();" class="logout-btn">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden sm:inline">Cerrar Sesión</span>
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('admin.pedidos.index') }}" class="nav-link">Pedidos</a>
                <a href="{{ route('admin.clientes.index') }}" class="nav-link">Clientes</a>
                <a href="{{ route('productos.index') }}" class="nav-link">Productos</a>
                <a href="{{ route('categorias.index') }}" class="nav-link">Categorías</a>
                <a href="{{ route('empleados.index') }}" class="nav-link">Empleados</a>
                <a href="{{ route('admin.pagos.index') }}" class="nav-link">Pagos</a>
                <a href="{{ route('admin.estadisticas') }}" class="nav-link">Estadísticas</a>
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
                                <h3 class="font-heading text-2xl font-bold">Panel Administrador</h3>
                                <p class="font-cursive text-sm opacity-80 italic">FastBite Management</p>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">
                            Sistema completo de gestión para restaurantes de comida rápida. 
                            Controla pedidos, clientes, productos y estadísticas desde un solo lugar.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937  0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937
1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div>
                        <h4 class="font-heading text-lg font-semibold mb-4">Enlaces Rápidos</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white transition-colors">Dashboard</a></li>
                            <li><a href="{{ route('admin.pedidos.index') }}" class="text-white/80 hover:text-white transition-colors">Gestión de Pedidos</a></li>
                            <li><a href="{{ route('productos.index') }}" class="text-white/80 hover:text-white transition-colors">Productos</a></li>
                            <li><a href="{{ route('admin.estadisticas') }}" class="text-white/80 hover:text-white transition-colors">Reportes</a></li>
                        </ul>
                    </div>

                    <!-- Soporte -->
                    <div>
                        <h4 class="font-heading text-lg font-semibold mb-4">Soporte</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Centro de Ayuda</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Documentación</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Contacto Técnico</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Términos de Uso</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/20 py-6">
                <div class="container mx-auto px-4 text-center">
                    <p class="text-white/70">
                        &copy; {{ date('Y') }} <span class="font-cursive italic">FastBite</span> Panel Administrador. 
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
