<x-filament-widgets::widget>
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                <div class="flex items-center space-x-2">
                    <span>Bandeja de Notificaciones</span>
                    @if($this->getNotificacionesNoLeidas() > 0)
                        <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                            {{ $this->getNotificacionesNoLeidas() }}
                        </span>
                    @endif
                </div>
            </h3>
            
            @if($this->getNotificacionesNoLeidas() > 0)
                <x-filament::button
                    size="sm"
                    wire:click="marcarTodasComoLeidas"
                    wire:loading.attr="disabled"
                >
                    Marcar todas como leídas
                </x-filament::button>
            @endif
        </div>

        <!-- Estadísticas por tipo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @foreach($this->getNotificacionesPorTipo() as $tipo)
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">
                                @switch($tipo->tipo)
                                    @case('pedido_asignado')
                                        Pedido Asignado
                                        @break
                                    @case('pedido_entregado')
                                        Pedido Entregado
                                        @break
                                    @case('calificacion_recibida')
                                        Calificación Recibida
                                        @break
                                    @default
                                        {{ ucfirst(str_replace('_', ' ', $tipo->tipo)) }}
                                @endswitch
                            </p>
                            <p class="text-2xl font-bold text-orange-600">{{ $tipo->cantidad }}</p>
                        </div>
                        <div class="p-2 rounded-full
                            @if($tipo->tipo === 'pedido_asignado') bg-blue-100 text-blue-600
                            @elseif($tipo->tipo === 'pedido_entregado') bg-green-100 text-green-600
                            @elseif($tipo->tipo === 'calificacion_recibida') bg-yellow-100 text-yellow-600
                            @else bg-gray-100 text-gray-600
                            @endif">
                            @if($tipo->tipo === 'pedido_asignado')
                                <i class="fa-solid fa-file-alt text-sm"></i>
                            @elseif($tipo->tipo === 'pedido_entregado')
                                <i class="fa-solid fa-check text-sm"></i>
                            @elseif($tipo->tipo === 'calificacion_recibida')
                                <i class="fa-solid fa-star text-sm"></i>
                            @else
                                <i class="fa-solid fa-info-circle text-sm"></i>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Lista de notificaciones -->
        <div class="space-y-3 mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Notificaciones Recientes</h3>
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
                                                @case('pedido_asignado')
                                                    <span class="text-blue-600">Pedido Asignado</span>
                                                    @break
                                                @case('pedido_entregado')
                                                    <span class="text-green-600">Pedido Entregado</span>
                                                    @break
                                                @case('calificacion_recibida')
                                                    <span class="text-yellow-600">Calificación Recibida</span>
                                                    @break
                                                @default
                                                    <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $notificacion->tipo)) }}</span>
                                            @endswitch
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $notificacion->fecha_envio->diffForHumans() }}</span>
                                </div>
                                
                                <p class="text-sm text-gray-700 mb-2">{{ $notificacion->mensaje }}</p>
                                
                                @if($notificacion->datos_adicionales)
                                    <div class="bg-gray-50 rounded-lg p-3 text-xs text-gray-600">
                                        <div class="grid grid-cols-2 gap-2">
                                            @if(isset($notificacion->datos_adicionales['pedido_id']))
                                                <div><span class="font-medium">Pedido:</span> #{{ $notificacion->datos_adicionales['pedido_id'] }}</div>
                                            @endif
                                            @if(isset($notificacion->datos_adicionales['cliente_nombre']))
                                                <div><span class="font-medium">Cliente:</span> {{ $notificacion->datos_adicionales['cliente_nombre'] }}</div>
                                            @endif
                                            @if(isset($notificacion->datos_adicionales['calificacion']))
                                                <div><span class="font-medium">Calificación:</span> {{ $notificacion->datos_adicionales['calificacion'] }}/5</div>
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
                    <i class="fa-solid fa-bell text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">No hay notificaciones</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget> 