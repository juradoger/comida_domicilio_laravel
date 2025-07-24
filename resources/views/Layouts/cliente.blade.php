<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Cliente')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-gradient {
            background: linear-gradient(135deg, #ea580c 0%, #fb923c 100%);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #ea580c 0%, #fb923c 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #ea580c 0%, #fb923c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
    <!-- Navbar para cliente -->
    <header class="navbar-gradient text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4">
            <div class="flex items-center gap-3">
                <img src="https://img.icons8.com/fluency/48/meal.png" alt="Logo" class="w-10 h-10">
                <span class="text-2xl font-extrabold text-gradient">Comida a Domicilio</span>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="{{ route('cliente.dashboard') }}"
                    class="hover:underline font-semibold transition">Dashboard</a>
                <a href="{{ route('cliente.menu') }}" class="hover:underline font-semibold transition">Menú</a>
                <a href="{{ route('cliente.carrito') }}" class="hover:underline font-semibold transition">Carrito</a>
                <a href="{{ route('cliente.pedidos.index') }}" class="hover:underline font-semibold transition">Mis
                    Pedidos</a>
                <a href="{{ route('cliente.pagos.index') }}" class="hover:underline font-semibold transition">Mis
                    Pagos</a>
                {{--    <a href="{{ route('cliente.calificaciones.index') }}"
                    class="hover:underline font-semibold transition">Calificaciones</a> --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 hover:underline font-semibold transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span
                            class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center absolute -top-1 -right-1">{{ Auth::user()->notificacionesNoLeidas()->count() }}</span>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h3 class="font-bold text-gray-800">Notificaciones</h3>
                        </div>
                        @if (Auth::user()->notificaciones()->count() > 0)
                            @foreach (Auth::user()->notificaciones()->latest()->take(5)->get() as $notificacion)
                                <div
                                    class="px-4 py-2 border-b border-gray-100 {{ $notificacion->leida ? 'bg-white' : 'bg-orange-50' }}">
                                    <p class="text-sm text-gray-800">{{ $notificacion->mensaje }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $notificacion->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                            <a href="{{ route('cliente.notificaciones.index') }}"
                                class="block px-4 py-2 text-center text-orange-600 hover:underline">Ver todas</a>
                        @else
                            <div class="px-4 py-2 text-center text-gray-500">
                                No tienes notificaciones
                            </div>
                        @endif
                    </div>
                </div>
                @auth
                    <div class="relative group ml-4">
                        <button
                            class="flex items-center gap-2 px-4 py-2 rounded btn-gradient text-white font-bold shadow hover:scale-105 transition">
                            {{ Auth::user()->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                            <a href="{{ route('cliente.perfil.edit') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Mi Perfil</a>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-orange-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="ml-4 px-4 py-2 rounded btn-gradient text-white font-bold shadow hover:scale-105 transition">Iniciar
                        Sesión</a>
                @endauth
            </nav>
        </div>
    </header>
    <!-- Contenido principal -->
    <main class="container mx-auto flex-1 mt-8">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>
    <!-- Footer para cliente -->
    <footer class="navbar-gradient text-white mt-10 shadow-inner">
        <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col gap-2">
                <span class="font-bold text-lg">Comida a Domicilio</span>
                <span class="text-sm">Servicio rápido y eficiente de comida a tu puerta.</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:underline">Términos</a>
                <a href="#" class="hover:underline">Privacidad</a>
                <a href="#" class="hover:underline">Soporte</a>
            </div>
            <div class="flex gap-4 items-center">
                <a href="#" title="Facebook"><img src="https://img.icons8.com/fluency/24/facebook-new.png"
                        alt="Facebook"></a>
                <a href="#" title="Instagram"><img src="https://img.icons8.com/fluency/24/instagram-new.png"
                        alt="Instagram"></a>
                <a href="#" title="WhatsApp"><img src="https://img.icons8.com/fluency/24/whatsapp.png"
                        alt="WhatsApp"></a>
            </div>
        </div>
        <div class="text-center text-xs py-2 bg-opacity-30 bg-black">&copy; {{ date('Y') }} Comida a Domicilio.
            Todos los derechos reservados.</div>
    </footer>
    @stack('scripts')
</body>

</html>
