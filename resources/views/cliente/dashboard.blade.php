@extends('Layouts.cliente')

@section('title', 'Dashboard - Cliente')
@section('header')
    <div class="relative min-h-[80vh] md:min-h-[90vh] w-full flex items-center justify-center overflow-hidden mb-10"
        style="
background: linear-gradient(135deg, rgba(234,88,12,0.7) 0%, rgba(251,146,60,0.5) 100%),
            url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
margin: 0; padding: 0; border-radius: 0; box-shadow: none;
">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10 flex flex-col items-center text-center w-full px-4 md:px-0">
            <h1 id="typewriter-title" class="text-4xl md:text-6xl font-extrabold mb-6 text-white drop-shadow-lg">¡Bienvenido,
                {{ Auth::user()->name }}!</h1>

            <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">
                <span id="typewriter-subtitle">Disfruta de los mejores platos desde la comodidad de tu hogar</span>
            </p>
        </div>
    </div>
@endsection

@section('content')
    <!-- Hero de comida a pantalla completa con imagen real -->

    <div class="space-y-6">
        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-700">{{ $totalPedidos }}</p>
                        <p class="text-gray-500">Total de Pedidos</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-700">{{ $pedidosPendientes }}</p>
                        <p class="text-gray-500">Pedidos Pendientes</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-700">{{ $totalPedidos - $pedidosPendientes }}</p>
                        <p class="text-gray-500">Pedidos Completados</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('cliente.menu') }}"
                    class="flex flex-col items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition group">
                    <div class="p-3 rounded-full bg-orange-500 text-white group-hover:bg-orange-600 transition mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-gray-700 font-medium">Ver Menú</span>
                </a>

                <a href="{{ route('cliente.carrito') }}"
                    class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition group">
                    <div class="p-3 rounded-full bg-blue-500 text-white group-hover:bg-blue-600 transition mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-gray-700 font-medium">Mi Carrito</span>
                </a>

                <a href="{{ route('cliente.pedidos.index') }}"
                    class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition group">
                    <div class="p-3 rounded-full bg-green-500 text-white group-hover:bg-green-600 transition mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span class="text-gray-700 font-medium">Mis Pedidos</span>
                </a>

                <a href="{{ route('cliente.perfil.edit') }}"
                    class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition group">
                    <div class="p-3 rounded-full bg-purple-500 text-white group-hover:bg-purple-600 transition mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span class="text-gray-700 font-medium">Mi Perfil</span>
                </a>
            </div>
        </div>

        <!-- Pedidos recientes -->
        @if (count($pedidosRecientes) > 0)
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Pedidos Recientes</h2>
                </div>

                <div class="space-y-4">
                    @foreach ($pedidosRecientes as $pedido)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium text-gray-800">Pedido #{{ $pedido->id }}</p>
                                    <p class="text-sm text-gray-600">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-sm text-gray-600">Total: <span class="text-xs align-top">Bs.
                                        </span>{{ number_format($pedido->total, 2, '.', ',') }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                            @if ($pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                            @elseif($pedido->estado == 'aceptado') bg-blue-100 text-blue-800
                            @elseif($pedido->estado == 'en_camino') bg-orange-100 text-orange-800
                            @elseif($pedido->estado == 'entregado') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                    </span>
                                    <a href="{{ route('cliente.pedidos.show', $pedido->id) }}"
                                        class="text-orange-500 hover:text-orange-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                            </path>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('cliente.pedidos.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[var(--color-primario)] to-[var(--color-secundario)] text-white font-semibold rounded-lg shadow hover:from-[var(--color-secundario)] hover:to-[var(--color-primario)] transition-colors duration-200 ml-auto mt-4">
                    Ver todos
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">No tienes pedidos aún</h3>
                    <p class="text-gray-600 mb-4">¡Explora nuestro menú y haz tu primer pedido!</p>
                    <a href="{{ route('cliente.menu') }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition">
                        Ver Menú
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        console.log('Script de typewriter cargado');
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado, iniciando typewriter');
            // Esperar un poco más para asegurar que todo esté renderizado
            setTimeout(function() {
                console.log('Aplicando efecto typewriter...');

                // Efecto typewriter para el título
                function typeWriter(element, text, speed = 100) {
                    console.log('Iniciando typewriter para:', text);
                    let i = 0;
                    element.innerHTML = '';

                    function type() {
                        if (i < text.length) {
                            element.innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, speed);
                        } else {
                            console.log('Typewriter completado para:', text);
                        }
                    }
                    type();
                }

                // Efecto typewriter para el subtítulo
                function typeWriterSubtitle(element, text, speed = 50) {
                    console.log('Iniciando typewriter para subtítulo:', text);
                    let i = 0;
                    element.innerHTML = '';

                    function type() {
                        if (i < text.length) {
                            element.innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, speed);
                        } else {
                            console.log('Typewriter completado para subtítulo:', text);
                        }
                    }
                    type();
                }

                // Aplicar efecto typewriter
                const titleElement = document.getElementById('typewriter-title');
                const subtitleElement = document.getElementById('typewriter-subtitle');

                console.log('Elementos encontrados:', {
                    title: titleElement,
                    subtitle: subtitleElement
                });

                if (titleElement) {
                    const titleText = titleElement.textContent.trim();
                    console.log('Aplicando typewriter al título:', titleText);
                    typeWriter(titleElement, titleText, 100);
                } else {
                    console.error('No se encontró el elemento typewriter-title');
                }

                if (subtitleElement) {
                    const subtitleText = subtitleElement.textContent.trim();
                    console.log('Aplicando typewriter al subtítulo:', subtitleText);
                    // Esperar un poco antes de empezar el subtítulo
                    setTimeout(() => {
                        typeWriterSubtitle(subtitleElement, subtitleText, 50);
                    }, 1500);
                } else {
                    console.error('No se encontró el elemento typewriter-subtitle');
                }
            }, 200); // Aumentado el delay para asegurar renderizado completo
        });
    </script>
@endpush
