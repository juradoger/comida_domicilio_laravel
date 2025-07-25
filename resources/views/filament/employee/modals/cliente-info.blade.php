<div class="space-y-6 p-6">
    <!-- Información Personal del Cliente -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Información Personal
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre:</label>
                <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->usuario->name ?? 'N/A' }}</p>
            </div>
            @if ($pedido->usuario->apellido)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido:</label>
                    <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->usuario->apellido }}</p>
                </div>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email:</label>
                <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->usuario->email ?? 'N/A' }}</p>
            </div>
            @if ($pedido->usuario->telefono || $pedido->usuario->phone)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono:</label>
                    <p class="text-gray-900 dark:text-white font-semibold">
                        {{ $pedido->usuario->telefono ?? ($pedido->usuario->phone ?? 'N/A') }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Dirección de Entrega -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Dirección de Entrega
        </h3>
        @if ($pedido->direccion)
            <div class="space-y-3">
                @if ($pedido->direccion->direccion)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección:</label>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->direccion->direccion }}</p>
                    </div>
                @endif
                @if ($pedido->direccion->ciudad)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ciudad:</label>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->direccion->ciudad }}</p>
                    </div>
                @endif
                @if ($pedido->direccion->codigo_postal)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código Postal:</label>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->direccion->codigo_postal }}
                        </p>
                    </div>
                @endif
                @if ($pedido->direccion->referencias)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Referencias:</label>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $pedido->direccion->referencias }}</p>
                    </div>
                @endif
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 italic">No hay dirección registrada para este pedido.</p>
        @endif
    </div>

    <!-- Información del Pedido -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            Resumen del Pedido
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subtotal:</label>
                <p class="text-gray-900 dark:text-white font-semibold">${{ number_format($pedido->subtotal, 2) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Costo de Envío:</label>
                <p class="text-gray-900 dark:text-white font-semibold">${{ number_format($pedido->costo_envio, 2) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total:</label>
                <p class="text-gray-900 dark:text-white font-bold text-lg">${{ number_format($pedido->total, 2) }}</p>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Entrega:</label>
                <p class="text-gray-900 dark:text-white font-semibold">
                    {{ $pedido->fecha_entrega->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado:</label>
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @switch($pedido->estado)
                        @case('pendiente') bg-gray-100 text-gray-800 @break
                        @case('en_preparacion') bg-yellow-100 text-yellow-800 @break
                        @case('en_camino') bg-blue-100 text-blue-800 @break
                        @case('entregado') bg-green-100 text-green-800 @break
                        @case('cancelado') bg-red-100 text-red-800 @break
                        @default bg-gray-100 text-gray-800
                    @endswitch
                ">
                    @switch($pedido->estado)
                        @case('pendiente')
                            Pendiente
                        @break

                        @case('en_preparacion')
                            En Preparación
                        @break

                        @case('en_camino')
                            En Camino
                        @break

                        @case('entregado')
                            Entregado
                        @break

                        @case('cancelado')
                            Cancelado
                        @break

                        @default
                            {{ $pedido->estado }}
                    @endswitch
                </span>
            </div>
        </div>
    </div>
</div>
