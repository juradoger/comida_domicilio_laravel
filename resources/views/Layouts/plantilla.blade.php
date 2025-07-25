<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mi sitio web')</title>
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
    <!-- Navbar estilizado con gradiente naranja y más elementos -->
    <header class="navbar-gradient text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4">
            <div class="flex items-center gap-3">
                <img src="https://img.icons8.com/fluency/48/meal.png" alt="Logo" class="w-10 h-10">
                <span class="text-2xl font-extrabold text-gradient">Comida a Domicilio</span>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="/cliente/dashboard" class="hover:underline font-semibold transition">Inicio</a>
                <a href="#menu" class="hover:underline font-semibold transition">Menú</a>
                <a href="#pedidos" class="hover:underline font-semibold transition">Pedidos</a>
                <a href="#contacto" class="hover:underline font-semibold transition">Contacto</a>
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
        @yield('content')
    </main>
    <!-- Footer estilizado con gradiente naranja y más información -->
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
