@extends('Layouts.guest')

@section('title', 'Menú de Productos')

@push('styles')
    <style>
        /* Animaciones personalizadas para los toasts */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .toast-enter {
            animation: slideInRight 0.3s ease-out forwards;
        }

        .toast-exit {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        /* Efecto hover mejorado para las cards de productos */
        .producto-card {
            transition: all 0.3s ease;
        }

        .producto-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para el contador del carrito con pulso */
        @keyframes pulse-cart {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .pulse-cart {
            animation: pulse-cart 0.5s ease-in-out;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Menú de Productos</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <form action="{{ route('cliente.menu') }}" method="GET" class="flex">
                        <input type="text" name="buscar" placeholder="Buscar productos..."
                            class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            value="{{ request('buscar') }}">
                        <button type="submit"
                            class="bg-orange-500 text-white px-4 py-2 rounded-r-md hover:bg-orange-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
                <a href="{{ route('cliente.carrito') }}"
                    class="relative flex items-center bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Carrito
                    <span
                        class="carrito-counter absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center {{ session('carrito') && count(session('carrito')) > 0 ? '' : 'hidden' }}">
                        {{ session('carrito') ? count(session('carrito')) : 0 }}
                    </span>
                </a>
            </div>
        </div>

        <!-- Filtro por categorías -->
        @if (isset($categorias) && count($categorias) > 0)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Categorías</h2>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('cliente.menu') }}"
                        class="px-4 py-2 rounded-full {{ !request('categoria') ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                        Todas
                    </a>
                    @foreach ($categorias as $categoria)
                        <a href="{{ route('cliente.menu', ['categoria' => $categoria->id]) }}"
                            class="px-4 py-2 rounded-full {{ request('categoria') == $categoria->id ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                            {{ $categoria->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Listado de productos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($productos as $producto)
                <div
                    class="producto-card bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/300x200?text=Sin+Imagen' }}"
                        alt="{{ $producto->nombre }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $producto->nombre }}</h3>
                        @if (isset($producto->categoria))
                            <p class="text-gray-600 text-sm mb-2">{{ $producto->categoria->nombre }}</p>
                        @endif
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-orange-600 font-bold">
                                <span class="text-xs align-top">Bs</span>
                                {{ number_format($producto->precio, 2, '.', ',') }}
                            </span>
                            <div class="flex items-center gap-2">
                                <input type="number" id="cantidad-{{ $producto->id }}" value="1" min="1"
                                    max="10" class="border rounded px-2 py-1 w-16 text-center">
                                @auth
                                    <button onclick="agregarAlCarrito({{ $producto->id }})"
                                        class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 transition flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Agregar
                                    </button>
                                @endauth

                                @guest

                                    <a href="{{ route('login') }}"
                                        class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 transition flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Agregar
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mt-4">No se encontraron productos</h3>
                    <p class="text-gray-500 mt-2">Intenta con otra búsqueda o categoría</p>
                </div>
            @endforelse
        </div>
    </div>

    @push('scripts')
        <script>
            function agregarAlCarrito(productoId) {
                const cantidad = document.getElementById('cantidad-' + productoId).value;
                const boton = event.target.closest('button');
                const productoCard = boton.closest('.bg-white');
                const nombreProducto = productoCard.querySelector('h3').textContent;

                // Deshabilitar el botón temporalmente
                boton.disabled = true;
                boton.classList.add('opacity-50', 'cursor-not-allowed');

                const textoOriginal = boton.innerHTML;
                boton.innerHTML = `
                    <svg class="animate-spin h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Agregando...
                `;

                fetch('{{ route('cliente.carrito.agregar') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            producto_id: productoId,
                            cantidad: parseInt(cantidad)
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar el contador del carrito
                            const carritoCounter = document.querySelector('.carrito-counter');
                            if (carritoCounter) {
                                carritoCounter.textContent = data.carrito_count;
                                carritoCounter.classList.remove('hidden');

                                // Animación del contador
                                carritoCounter.classList.add('animate-pulse');
                                setTimeout(() => {
                                    carritoCounter.classList.remove('animate-pulse');
                                }, 1000);
                            }

                            // Mostrar notificación con información específica
                            const mensaje = cantidad > 1 ?
                                `${cantidad} unidades de "${nombreProducto}" agregadas al carrito` :
                                `"${nombreProducto}" agregado al carrito`;
                            mostrarNotificacion(mensaje, 'success');

                            // Resetear el input de cantidad
                            document.getElementById('cantidad-' + productoId).value = 1;
                        } else {
                            mostrarNotificacion(data.message || 'Error al agregar el producto', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarNotificacion('Error de conexión. Intenta nuevamente.', 'error');
                    })
                    .finally(() => {
                        // Restaurar el botón
                        boton.disabled = false;
                        boton.classList.remove('opacity-50', 'cursor-not-allowed');
                        boton.innerHTML = textoOriginal;
                    });
            }

            function mostrarNotificacion(mensaje, tipo) {
                // Crear elemento de notificación
                const notificacion = document.createElement('div');

                // Configurar clases base
                const baseClasses =
                    'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out flex items-center gap-3 max-w-sm';
                const tipoClasses = tipo === 'success' ?
                    'bg-green-500 text-white border-l-4 border-green-600' :
                    'bg-red-500 text-white border-l-4 border-red-600';

                notificacion.className = `${baseClasses} ${tipoClasses} translate-x-full opacity-0`;

                // Crear icono
                const icono = document.createElement('div');
                icono.className = 'flex-shrink-0';

                if (tipo === 'success') {
                    icono.innerHTML = `
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    `;
                } else {
                    icono.innerHTML = `
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    `;
                }

                // Crear texto
                const textoEl = document.createElement('div');
                textoEl.className = 'flex-1 font-medium';
                textoEl.textContent = mensaje;

                // Crear botón de cerrar
                const cerrarBtn = document.createElement('button');
                cerrarBtn.className = 'flex-shrink-0 ml-2 text-white hover:text-gray-200 transition-colors';
                cerrarBtn.innerHTML = `
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                `;

                // Ensamblar la notificación
                notificacion.appendChild(icono);
                notificacion.appendChild(textoEl);
                notificacion.appendChild(cerrarBtn);

                document.body.appendChild(notificacion);

                // Animar entrada
                setTimeout(() => {
                    notificacion.classList.remove('translate-x-full', 'opacity-0');
                    notificacion.classList.add('translate-x-0', 'opacity-100');
                }, 10);

                // Función para remover la notificación
                const removerNotificacion = () => {
                    notificacion.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (notificacion.parentNode) {
                            notificacion.parentNode.removeChild(notificacion);
                        }
                    }, 300);
                };

                // Evento para cerrar manualmente
                cerrarBtn.addEventListener('click', removerNotificacion);

                // Auto-remover después de 4 segundos
                setTimeout(removerNotificacion, 4000);

                // Hacer que la notificación se pueda cerrar haciendo click en ella
                notificacion.addEventListener('click', (e) => {
                    if (e.target !== cerrarBtn && !cerrarBtn.contains(e.target)) {
                        removerNotificacion();
                    }
                });
            }
        </script>
    @endpush
@endsection
