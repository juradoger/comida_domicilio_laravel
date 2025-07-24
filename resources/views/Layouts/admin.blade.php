<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Panel Administrador')</title>
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

        .sidebar-link {
            @apply flex items-center gap-2 py-2 px-4 rounded-lg transition-all;
        }

        .sidebar-link:hover {
            @apply bg-orange-100 text-orange-600;
        }

        .sidebar-link.active {
            @apply bg-orange-500 text-white;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
    <!-- Navbar para administrador -->
    <header class="navbar-gradient text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4">
            <div class="flex items-center gap-3">
                <img src="https://img.icons8.com/fluency/48/meal.png" alt="Logo" class="w-10 h-10">
                <span class="text-2xl font-extrabold text-gradient">Panel Administrador</span>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline font-semibold transition">Dashboard</a>
                <a href="{{ route('admin.pedidos.index') }}"
                    class="hover:underline font-semibold transition">Pedidos</a>
                <a href="{{ route('admin.clientes.index') }}"
                    class="hover:underline font-semibold transition">Clientes</a>
                <a href="{{ route('admin.empleados.empleados.empleados.empleados.index') }}"
                    class="hover:underline font-semibold transition">Empleados</a>
                <a href="{{ route('productos.index') }}" class="hover:underline font-semibold transition">Productos</a>
                <a href="{{ route('categorias.index') }}"
                    class="hover:underline font-semibold transition">Categorías</a>
                <div class="relative group">
                    <button class="flex items-center gap-1 hover:underline font-semibold transition">
                        Más <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                        <a href="{{ route('admin.pagos.index') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Pagos</a>
                        <a href="{{ route('admin.calificaciones.index') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Calificaciones</a>
                        <a href="{{ route('admin.notificaciones.index') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Notificaciones</a>
                        <a href="{{ route('admin.estadisticas') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-orange-100">Estadísticas</a>
                    </div>
                </div>
                @auth
                    <a href="{{ route('logout') }}"
                        class="ml-4 px-4 py-2 rounded btn-gradient text-white font-bold shadow hover:scale-105 transition"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
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
    <!-- Footer para administrador -->
    <footer class="navbar-gradient text-white mt-10 shadow-inner">
        <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col gap-2">
                <span class="font-bold text-lg">Panel Administrador</span>
                <span class="text-sm">Gestión completa del sistema de comida a domicilio.</span>
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
        <div class="text-center text-xs py-2 bg-opacity-30 bg-black">&copy; {{ date('Y') }} Panel Administrador.
            Todos los derechos reservados.</div>
    </footer>
    @stack('scripts')
</body>

</html>
