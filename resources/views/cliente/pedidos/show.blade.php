@extends('Layouts.cliente')

@section('title', 'Detalle de Pedido')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Detalle de Pedido #{{ $pedido->id }}</h2>
            <a href="{{ route('cliente.pedidos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Mis Pedidos
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Información del pedido -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-800">Información del Pedido</h3>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if ($pedido->estado == 'Entregado') bg-green-100 text-green-800
                                @elseif($pedido->estado == 'En proceso') bg-blue-100 text-blue-800
                                @elseif($pedido->estado == 'En camino') bg-indigo-100 text-indigo-800
                                @elseif($pedido->estado == 'Cancelado') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $pedido->estado }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Fecha del pedido</h4>
                                <p class="text-gray-800">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Fecha de entrega</h4>
                                <p class="text-gray-800">
                                    @if ($pedido->fecha_entrega)
                                        {{ $pedido->fecha_entrega->format('d/m/Y H:i') }}
                                    @elseif($pedido->estado == 'Cancelado')
                                        N/A
                                    @else
                                        Pendiente
                                    @endif
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Método de pago</h4>
                                <p class="text-gray-800">{{ ucfirst($pedido->metodo_pago) }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Estado del pago</h4>
                                <p class="text-gray-800">
                                    @if ($pedido->pagado)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Pagado
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pendiente
                                        </span>
                                    @endif
                                </p>
                            </div>

                            @if ($pedido->repartidor)
                                <div class="md:col-span-2">
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Repartidor</h4>
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            @if ($pedido->repartidor->foto)
                                                <img src="{{ asset('storage/' . $pedido->repartidor->foto) }}"
                                                    alt="Foto del repartidor" class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <i class="fas fa-user text-gray-400"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-gray-800">{{ $pedido->repartidor->usuario->name }}
                                                {{ $pedido->repartidor->usuario->apellido }}</p>
                                            <p class="text-sm text-gray-500">{{ $pedido->repartidor->usuario->telefono }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($pedido->instrucciones)
                                <div class="md:col-span-2">
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Instrucciones especiales</h4>
                                    <p class="text-gray-800">{{ $pedido->instrucciones }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Productos del pedido -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Productos</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($pedido->detalles as $detalle)
                                <div
                                    class="flex items-start justify-between pb-4 border-b border-gray-200 last:border-0 last:pb-0">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-16 h-16">
                                            @if ($detalle->producto && $detalle->producto->imagen)
                                                <img class="w-16 h-16 object-cover rounded"
                                                    src="{{ asset('storage/' . $detalle->producto->imagen) }}"
                                                    alt="{{ $detalle->producto->nombre }}">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                    <i class="fas fa-utensils text-gray-400 text-xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-gray-800 font-medium">
                                                @if ($detalle->producto)
                                                    {{ $detalle->producto->nombre }}
                                                @else
                                                    <span class="text-gray-500 italic">Producto no disponible</span>
                                                @endif
                                            </h4>
                                            <p class="text-sm text-gray-500">
                                                @if ($detalle->producto && $detalle->producto->categoria)
                                                    {{ $detalle->producto->categoria->nombre }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">Cantidad: {{ $detalle->cantidad }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-600">Bs. {{ number_format($detalle->precio_unitario, 2) }} x
                                            {{ $detalle->cantidad }}</p>
                                        <p class="font-bold text-gray-800 mt-1">Bs.
                                            {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Seguimiento del pedido -->
                @if ($pedido->estado != 'Cancelado')
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Seguimiento del Pedido</h3>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <!-- Línea de tiempo vertical -->
                                <div class="absolute left-5 top-0 h-full w-0.5 bg-gray-200"></div>

                                <!-- Estados del pedido -->
                                <div class="space-y-8">
                                    <!-- Pedido recibido -->
                                    <div class="relative flex items-start">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white z-10">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="ml-6">
                                            <h4 class="text-gray-800 font-medium">Pedido recibido</h4>
                                            <p class="text-sm text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">Tu pedido ha sido recibido y está siendo
                                                procesado.</p>
                                        </div>
                                    </div>

                                    <!-- En preparación -->
                                    <div class="relative flex items-start">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-full {{ $pedido->estado == 'Pendiente' ? 'bg-gray-300' : 'bg-green-500 text-white' }} z-10">
                                            <i
                                                class="fas {{ $pedido->estado == 'Pendiente' ? 'fa-clock' : 'fa-check' }}"></i>
                                        </div>
                                        <div class="ml-6">
                                            <h4 class="text-gray-800 font-medium">En preparación</h4>
                                            @if ($pedido->estado != 'Pendiente')
                                                <p class="text-sm text-gray-500">
                                                    {{ $pedido->updated_at->format('d/m/Y H:i') }}</p>
                                                <p class="text-sm text-gray-600 mt-1">Tu pedido está siendo preparado por
                                                    nuestros cocineros.</p>
                                            @else
                                                <p class="text-sm text-gray-500">Pendiente</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- En camino -->
                                    <div class="relative flex items-start">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-full {{ in_array($pedido->estado, ['Pendiente', 'En proceso']) ? 'bg-gray-300' : 'bg-green-500 text-white' }} z-10">
                                            <i
                                                class="fas {{ in_array($pedido->estado, ['Pendiente', 'En proceso']) ? 'fa-clock' : 'fa-check' }}"></i>
                                        </div>
                                        <div class="ml-6">
                                            <h4 class="text-gray-800 font-medium">En camino</h4>
                                            @if ($pedido->estado == 'En camino' || $pedido->estado == 'Entregado')
                                                <p class="text-sm text-gray-500">
                                                    {{ $pedido->updated_at->format('d/m/Y H:i') }}</p>
                                                <p class="text-sm text-gray-600 mt-1">Tu pedido está en camino a tu
                                                    dirección.</p>
                                            @else
                                                <p class="text-sm text-gray-500">Pendiente</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Entregado -->
                                    <div class="relative flex items-start">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-full {{ $pedido->estado != 'Entregado' ? 'bg-gray-300' : 'bg-green-500 text-white' }} z-10">
                                            <i
                                                class="fas {{ $pedido->estado != 'Entregado' ? 'fa-clock' : 'fa-check' }}"></i>
                                        </div>
                                        <div class="ml-6">
                                            <h4 class="text-gray-800 font-medium">Entregado</h4>
                                            @if ($pedido->estado == 'Entregado')
                                                <p class="text-sm text-gray-500">
                                                    {{ $pedido->fecha_entrega->format('d/m/Y H:i') }}</p>
                                                <p class="text-sm text-gray-600 mt-1">Tu pedido ha sido entregado. ¡Buen
                                                    provecho!</p>
                                            @else
                                                <p class="text-sm text-gray-500">Pendiente</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Acciones disponibles -->
                <div class="flex flex-wrap gap-4 justify-end">
                    @if ($pedido->estado == 'Entregado' && !$pedido->calificacion)
                        <a href="{{ route('cliente.calificaciones.create', ['pedido_id' => $pedido->id]) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            <i class="fas fa-star mr-2"></i> Calificar Entrega
                        </a>
                    @endif

                    @if ($pedido->estado == 'Pendiente')
                        <form action="{{ route('cliente.pedidos.cancelar', $pedido->id) }}" method="POST"
                            class="inline" onsubmit="return confirm('¿Estás seguro de cancelar este pedido?')">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                <i class="fas fa-times mr-2"></i> Cancelar Pedido
                            </button>
                        </form>
                    @endif

                    @if (!$pedido->pagado && in_array($pedido->estado, ['Pendiente', 'En proceso', 'En camino']))
                        <a href="{{ route('cliente.pagos.create', ['pedido_id' => $pedido->id]) }}"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            <i class="fas fa-credit-card mr-2"></i> Realizar Pago
                        </a>
                    @endif
                </div>
            </div>

            <!-- Resumen y dirección de entrega -->
            <div>
                <!-- Resumen del pedido -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Resumen</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">Bs. {{ number_format($pedido->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Costo de envío:</span>
                            <span class="font-medium">Bs. {{ number_format($pedido->costo_envio, 2) }}</span>
                        </div>
                        @if ($pedido->descuento > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Descuento:</span>
                                <span class="font-medium">- Bs. {{ number_format($pedido->descuento, 2) }}</span>
                            </div>
                        @endif
                        <div class="pt-4 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800">Total:</span>
                                <span class="text-xl font-bold text-orange-600">Bs.
                                    {{ number_format($pedido->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dirección de entrega -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Dirección de Entrega</h3>
                    </div>
                    <div class="p-6">
                        @if ($pedido->direccion)
                            <div class="space-y-3">
                                <p class="text-gray-800 font-medium">{{ $pedido->direccion->nombre }}</p>
                                <p class="text-gray-700"><i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    {{ $pedido->direccion->direccion }}</p>
                                @if ($pedido->direccion->referencia)
                                    <p class="text-gray-600 text-sm"><i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                        {{ $pedido->direccion->referencia }}</p>
                                @endif
                                <p class="text-gray-700"><i class="fas fa-phone text-green-500 mr-2"></i>
                                    {{ $pedido->direccion->telefono }}</p>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Información de dirección no disponible</p>
                        @endif
                    </div>
                </div>

                <!-- Calificación -->
                @if ($pedido->calificacion)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Tu Calificación</h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= $pedido->calificacion->puntuacion ? 'text-yellow-400' : 'text-gray-300' }} mr-1"></i>
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-600">{{ $pedido->calificacion->puntuacion }}/5</span>
                            </div>

                            @if ($pedido->calificacion->comentario)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Tu comentario:</h4>
                                    <p class="text-gray-700">{{ $pedido->calificacion->comentario }}</p>
                                </div>
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('cliente.calificaciones.edit', $pedido->calificacion->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-edit mr-1"></i> Editar calificación
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
