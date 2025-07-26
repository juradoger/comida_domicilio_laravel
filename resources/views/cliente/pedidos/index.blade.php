@extends('Layouts.cliente')

@section('title', 'Mis Pedidos')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Mis Pedidos</h1>
                <a href="{{ route('cliente.menu') }}"
                    class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Hacer nuevo pedido
                </a>
            </div>
        </div>

        <!-- Filtros de estado -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-wrap gap-2 mb-4">
                <a href="{{ route('cliente.pedidos.index') }}"
                    class="px-4 py-2 rounded-full {{ !request('estado') ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    Todos
                </a>
                <a href="{{ route('cliente.pedidos.index', ['estado' => 'pendiente']) }}"
                    class="px-4 py-2 rounded-full {{ request('estado') == 'pendiente' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    Pendiente
                </a>
                <a href="{{ route('cliente.pedidos.index', ['estado' => 'aceptado']) }}"
                    class="px-4 py-2 rounded-full {{ request('estado') == 'aceptado' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    Aceptado
                </a>
                <a href="{{ route('cliente.pedidos.index', ['estado' => 'en_camino']) }}"
                    class="px-4 py-2 rounded-full {{ request('estado') == 'en_camino' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    En Camino
                </a>
                <a href="{{ route('cliente.pedidos.index', ['estado' => 'entregado']) }}"
                    class="px-4 py-2 rounded-full {{ request('estado') == 'entregado' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    Entregado
                </a>
            </div>
        </div>

        <!-- Lista de pedidos -->
        @if (count($pedidos) > 0)
            <div class="space-y-4">
                @foreach ($pedidos as $pedido)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Pedido #{{ $pedido->id }}</h3>
                                <p class="text-gray-600">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                @if ($pedido->direcciones->isNotEmpty())
                                    <p class="text-sm text-gray-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        Entrega a domicilio
                                    </p>
                                @else
                                    <p class="text-sm text-gray-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Recoger en tienda
                                    </p>
                                @endif
                            </div>
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if ($pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                            @elseif($pedido->estado == 'aceptado') bg-blue-100 text-blue-800
                            @elseif($pedido->estado == 'en_camino') bg-orange-100 text-orange-800
                            @elseif($pedido->estado == 'entregado') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                                    @if ($pedido->estado == 'pendiente')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @elseif($pedido->estado == 'aceptado')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    @elseif($pedido->estado == 'en_camino')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                    @elseif($pedido->estado == 'entregado')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                    {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                </span>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    <span class="text-xs align-top">Bs</span>
                                    {{ number_format($pedido->total, 2, '.', ',') }}
                                </p>
                            </div>
                        </div>

                        <!-- Productos del pedido (resumen) -->
                        @if ($pedido->detalles->isNotEmpty())
                            <div class="mb-4">
                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                    @foreach ($pedido->detalles->take(3) as $detalle)
                                        <span class="bg-gray-100 px-2 py-1 rounded">
                                            {{ $detalle->cantidad }}x {{ $detalle->producto->nombre }}
                                        </span>
                                    @endforeach
                                    @if ($pedido->detalles->count() > 3)
                                        <span class="text-gray-500">y {{ $pedido->detalles->count() - 3 }} más...</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Información de entrega -->
                        @if ($pedido->fecha_entrega)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Fecha estimada de entrega: {{ $pedido->fecha_entrega->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        @endif

                        <!-- Acciones -->
                        <div class="flex justify-between items-center">
                            <div class="space-x-2">
                                @if ($pedido->estado == 'pendiente')
                                    <form action="{{ route('cliente.pedidos.cancelar', $pedido->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de cancelar este pedido?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition">
                                            Cancelar
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="space-x-2">
                                <a href="{{ route('cliente.pedidos.show', $pedido->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[var(--color-primario)] to-[var(--color-secundario)] text-white font-semibold rounded-lg shadow hover:from-[var(--color-secundario)] hover:to-[var(--color-primario)] transition-colors duration-200">
                                    Ver detalles
                                </a>
                                @if ($pedido->estado == 'entregado')
                                    <a href="{{ route('cliente.calificaciones.crear', ['pedido' => $pedido->id]) }}"
                                        class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                        Calificar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            @if (method_exists($pedidos, 'links'))
                <div class="mt-6">
                    {{ $pedidos->links() }}
                </div>
            @endif
        @else
            <!-- Estado vacío -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h2 class="text-xl font-medium text-gray-800 mb-2">No tienes pedidos aún</h2>
                <p class="text-gray-600 mb-6">Explora nuestro delicioso menú y haz tu primer pedido</p>
                <a href="{{ route('cliente.menu') }}"
                    class="inline-flex items-center px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Ver Menú
                </a>
            </div>
        @endif
    </div>
@endsection
