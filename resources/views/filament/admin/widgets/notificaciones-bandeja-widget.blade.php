<x-filament-widgets::widget>
    <x-filament-widgets::widget-header>
        <x-filament-widgets::widget-header-heading>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span>Bandeja de Notificaciones</span>
                @if($this->getNotificacionesNoLeidas() > 0)
                    <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                        {{ $this->getNotificacionesNoLeidas() }}
                    </span>
                @endif
            </div>
        </x-filament-widgets::widget-header-heading>
        
        @if($this->getNotificacionesNoLeidas() > 0)
            <x-filament-widgets::widget-header-actions>
                <x-filament::button
                    size="sm"
                    wire:click="marcarTodasComoLeidas"
                    wire:loading.attr="disabled"
                >
                    Marcar todas como leídas
                </x-filament::button>
            </x-filament-widgets::widget-header-actions>
        @endif
    </x-filament-widgets::widget-header>

    <!-- Estadísticas por tipo -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @foreach($this->getNotificacionesPorTipo() as $tipo)
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">
                            @switch($tipo->tipo)
                                @case('stock_agotado')
                                    Stock Agotado
                                    @break
                                @case('stock_bajo')
                                    Stock Bajo
                                    @break
                                @default
                                    {{ ucfirst(str_replace('_', ' ', $tipo->tipo)) }}
                            @endswitch
                        </p>
                        <p class="text-2xl font-bold text-orange-600">{{ $tipo->cantidad }}</p>
                    </div>
                    <div class="p-2 rounded-full
                        @if($tipo->tipo === 'stock_agotado') bg-red-100 text-red-600
                        @elseif($tipo->tipo === 'stock_bajo') bg-yellow-100 text-yellow-600
                        @else bg-blue-100 text-blue-600
                        @endif">
                        @if($tipo->tipo === 'stock_agotado')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        @elseif($tipo->tipo === 'stock_bajo')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Lista de notificaciones -->
    <div class="space-y-3">
        @if($this->getNotificaciones()->count() > 0)
            @foreach($this->getNotificaciones() as $notificacion)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 {{ !$notificacion->leido ? 'border-l-4 border-l-orange-500' : '' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="flex items-center space-x-2">
                                    @if(!$notificacion->leido)
                                        <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">
                                        @switch($notificacion->tipo)
                                            @case('stock_agotado')
                                                <span class="text-red-600">Stock Agotado</span>
                                                @break
                                            @case('stock_bajo')
                                                <span class="text-yellow-600">Stock Bajo</span>
                                                @break
                                            @default
                                                <span class="text-blue-600">{{ ucfirst(str_replace('_', ' ', $notificacion->tipo)) }}</span>
                                        @endswitch
                                    </span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $notificacion->fecha_envio->diffForHumans() }}</span>
                            </div>
                            
                            <p class="text-sm text-gray-700 mb-2">{{ $notificacion->mensaje }}</p>
                            
                            @if($notificacion->datos_adicionales)
                                <div class="bg-gray-50 rounded-lg p-3 text-xs text-gray-600">
                                    <div class="grid grid-cols-2 gap-2">
                                        @if(isset($notificacion->datos_adicionales['producto_nombre']))
                                            <div><span class="font-medium">Producto:</span> {{ $notificacion->datos_adicionales['producto_nombre'] }}</div>
                                        @endif
                                        @if(isset($notificacion->datos_adicionales['stock_actual']))
                                            <div><span class="font-medium">Stock actual:</span> {{ $notificacion->datos_adicionales['stock_actual'] }} unidades</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="ml-4">
                            @if(!$notificacion->leido)
                                <x-filament::button
                                    size="xs"
                                    wire:click="marcarComoLeida({{ $notificacion->id }})"
                                    wire:loading.attr="disabled"
                                >
                                    Marcar como leída
                                </x-filament::button>
                            @else
                                <span class="text-xs text-gray-400">Leída</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500">No hay notificaciones</p>
            </div>
        @endif
    </div>
</x-filament-widgets::widget> 