<div class="space-y-6 p-6">
    <!-- Información General del Pedido -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            Información del Pedido #{{ $pedido->id }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cliente:</label>
                <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->usuario->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha del Pedido:</label>
                <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Entrega:</label>
                <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->fecha_entrega->format('d/m/Y H:i') }}
                </p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado:</label>
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $pedido->estado === 'pendiente' ? 'bg-gray-100 text-gray-800' : '' }}
                    {{ $pedido->estado === 'aceptado' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $pedido->estado === 'en_camino' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $pedido->estado === 'entregado' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $pedido->estado === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}
                ">
                    {{ match ($pedido->estado) {
                        'pendiente' => 'Pendiente',
                        'aceptado' => 'Aceptado',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                        default => $pedido->estado,
                    } }}
                </span>
            </div>
        </div>
    </div>

    <!-- Productos del Pedido -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Productos Pedidos
        </h3>
        @if ($pedido->detalles && $pedido->detalles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Producto
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Precio Unitario
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                                            </div>
                                            @if ($detalle->producto && $detalle->producto->descripcion)
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ Str::limit($detalle->producto->descripcion, 50) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $detalle->cantidad }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    Bs. {{ number_format($detalle->precio_unitario, 2) }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    Bs. {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No hay productos</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No se encontraron productos en este pedido.</p>
            </div>
        @endif
    </div>

    <!-- Resumen de Costos -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17V7a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6m-6 0v2a2 2 0 002 2h2a2 2 0 002-2v-2m-6 0V7m6 10V7" />
            </svg>
            Resumen de Costos
        </h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                <span class="text-gray-700 dark:text-gray-300">Subtotal:</span>
                <span class="font-semibold text-gray-900 dark:text-white">Bs.
                    {{ number_format($pedido->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                <span class="text-gray-700 dark:text-gray-300">Costo de Envío:</span>
                <span class="font-semibold text-gray-900 dark:text-white">Bs.
                    {{ number_format($pedido->costo_envio, 2) }}</span>
            </div>
            <div class="flex justify-between items-center py-3 border-t-2 border-gray-300 dark:border-gray-600">
                <span class="text-lg font-bold text-gray-900 dark:text-white">Total:</span>
                <span class="text-xl font-bold text-green-600 dark:text-green-400">Bs.
                    {{ number_format($pedido->total, 2) }}</span>
            </div>
        </div>
    </div>

    @if ($pedido->direccion)
        <!-- Dirección de Entrega -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Dirección de Entrega
            </h3>
            <div class="bg-white dark:bg-gray-700 rounded-lg p-4">
                <p class="text-gray-900 dark:text-white font-semibold">
                    {{ $pedido->direccion->direccion ?? 'Dirección no especificada' }}
                </p>
                @if ($pedido->direccion->ciudad)
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ $pedido->direccion->ciudad }}
                        @if ($pedido->direccion->codigo_postal)
                            - {{ $pedido->direccion->codigo_postal }}
                        @endif
                    </p>
                @endif
                @if ($pedido->direccion->referencias)
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        <strong>Referencias:</strong> {{ $pedido->direccion->referencias }}
                    </p>
                @endif
            </div>
        </div>
    @endif
</div>
