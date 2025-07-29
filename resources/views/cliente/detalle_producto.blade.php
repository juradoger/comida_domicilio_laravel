@extends('Layouts.cliente')

@section('title', $producto->nombre . ' - Detalle del Producto')

@push('styles')
<style>
    .product-image {
        transition: transform 0.3s ease;
    }
    
    .product-image:hover {
        transform: scale(1.05);
    }
    
    .quantity-input {
        -moz-appearance: textfield;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    .add-to-cart-btn {
        transition: all 0.3s ease;
    }
    
    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .stock-badge {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('cliente.menu') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orange-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Menú
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $producto->nombre }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
            <!-- Imagen del producto -->
            <div class="relative overflow-hidden">
                <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/600x400?text=Sin+Imagen' }}"
                     alt="{{ $producto->nombre }}" 
                     class="product-image w-full h-96 lg:h-full object-cover">
                
                <!-- Badge de stock -->
                @if($producto->stock <= 5 && $producto->stock > 0)
                    <div class="absolute top-4 right-4">
                        <span class="stock-badge bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Solo {{ $producto->stock }} disponibles
                        </span>
                    </div>
                @elseif($producto->stock == 0)
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Agotado
                        </span>
                    </div>
                @endif
            </div>

            <!-- Información del producto -->
            <div class="p-8">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $producto->nombre }}</h1>
                    
                    @if(isset($producto->categoria))
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                {{ $producto->categoria->nombre }}
                            </span>
                        </div>
                    @endif

                    <div class="flex items-center mb-4">
                        <span class="text-3xl font-bold text-orange-600">
                            <span class="text-sm align-top">Bs.</span>
                            {{ number_format($producto->precio, 2, '.', ',') }}
                        </span>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Descripción</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $producto->descripcion ?: 'Sin descripción disponible.' }}</p>
                    </div>

                    <!-- Información adicional -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Stock disponible</p>
                                    <p class="font-semibold text-gray-900">{{ $producto->stock }} unidades</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Tiempo de preparación</p>
                                    <p class="font-semibold text-gray-900">15-20 min</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="border-t pt-6">
                    @if($producto->stock > 0)
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="cantidad" class="text-sm font-medium text-gray-700">Cantidad:</label>
                            <div class="flex items-center border rounded-lg">
                                <button type="button" onclick="cambiarCantidad(-1)" class="px-3 py-2 text-gray-600 hover:text-gray-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <input type="number" id="cantidad" value="1" min="1" max="{{ min($producto->stock, 10) }}" 
                                       class="quantity-input w-16 text-center border-0 focus:ring-0 focus:outline-none">
                                <button type="button" onclick="cambiarCantidad(1)" class="px-3 py-2 text-gray-600 hover:text-gray-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button onclick="agregarAlCarrito({{ $producto->id }})" 
                                class="add-to-cart-btn w-full bg-orange-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-orange-600 transition-all duration-300 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Agregar al Carrito</span>
                        </button>
                    @else
                        <div class="text-center py-6">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-lg font-medium text-gray-900 mb-2">Producto Agotado</p>
                            <p class="text-gray-600">Este producto no está disponible en este momento.</p>
                        </div>
                    @endif

                    <div class="mt-4 text-center">
                        <a href="{{ route('cliente.menu') }}" 
                           class="text-orange-600 hover:text-orange-700 font-medium">
                            ← Volver al Menú
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function cambiarCantidad(delta) {
    const input = document.getElementById('cantidad');
    const nuevaCantidad = parseInt(input.value) + delta;
    const max = parseInt(input.getAttribute('max'));
    const min = parseInt(input.getAttribute('min'));
    
    if (nuevaCantidad >= min && nuevaCantidad <= max) {
        input.value = nuevaCantidad;
    }
}

function agregarAlCarrito(productoId) {
    const cantidad = document.getElementById('cantidad').value;
    const boton = event.target.closest('button');
    const nombreProducto = '{{ $producto->nombre }}';

    // Deshabilitar el botón temporalmente
    boton.disabled = true;
    boton.classList.add('opacity-50', 'cursor-not-allowed');

    const textoOriginal = boton.innerHTML;
    boton.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                carritoCounter.classList.add('animate-pulse');
                setTimeout(() => {
                    carritoCounter.classList.remove('animate-pulse');
                }, 1000);
            }

            // Mostrar notificación
            const mensaje = cantidad > 1 ?
                `${cantidad} unidades de "${nombreProducto}" agregadas al carrito` :
                `"${nombreProducto}" agregado al carrito`;
            mostrarNotificacion(mensaje, 'success');

            // Resetear cantidad
            document.getElementById('cantidad').value = 1;
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
    const notificacion = document.createElement('div');
    const baseClasses = 'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out flex items-center gap-3 max-w-sm';
    
    if (tipo === 'success') {
        notificacion.className = baseClasses + ' bg-green-500 text-white';
        notificacion.innerHTML = `
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>${mensaje}</span>
        `;
    } else {
        notificacion.className = baseClasses + ' bg-red-500 text-white';
        notificacion.innerHTML = `
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span>${mensaje}</span>
        `;
    }

    document.body.appendChild(notificacion);
    notificacion.classList.add('toast-enter');

    setTimeout(() => {
        notificacion.classList.add('toast-exit');
        setTimeout(() => {
            document.body.removeChild(notificacion);
        }, 300);
    }, 3000);
}
</script>
@endpush
@endsection 