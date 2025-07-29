<x-filament-widgets::widget>
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                Notificaciones de Stock
            </h3>

            @if ($this->getNotificacionesNoLeidas() > 0)
                <x-filament::button size="sm" wire:click="marcarTodasComoLeidas" wire:loading.attr="disabled">
                    Marcar todas como leídas
                </x-filament::button>
            @endif
        </div>

        <div class="space-y-4">
            @if ($this->getNotificaciones()->count() > 0)
                @foreach ($this->getNotificaciones() as $notificacion)
                    <div
                        class="p-4 bg-white rounded-lg shadow-sm border {{ !$notificacion->leido ? 'border-orange-200 bg-orange-50' : 'border-gray-200' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    @if ($notificacion->tipo === 'stock_agotado')
                                        <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-red-500" />
                                    @elseif($notificacion->tipo === 'stock_bajo')
                                        <x-heroicon-o-exclamation-circle class="w-5 h-5 text-orange-500" />
                                    @else
                                        <x-heroicon-o-bell class="w-5 h-5 text-blue-500" />
                                    @endif

                                    <h3 class="text-sm font-medium text-gray-900">
                                        {{ $notificacion->mensaje }}
                                    </h3>

                                    @if (!$notificacion->leido)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Nuevo
                                        </span>
                                    @endif
                                </div>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $notificacion->fecha_envio->diffForHumans() }}
                                </p>

                                @if ($notificacion->datos_adicionales)
                                    <div class="mt-2 text-xs text-gray-600">
                                        @if (isset($notificacion->datos_adicionales['productos']))
                                            <strong>Productos afectados:</strong>
                                            <ul class="mt-1 ml-4 list-disc">
                                                @foreach ($notificacion->datos_adicionales['productos'] as $producto)
                                                    @if (is_array($producto))
                                                        <li>{{ $producto['nombre'] }} ({{ $producto['stock_actual'] }}
                                                            unidades)</li>
                                                    @else
                                                        <li>{{ $producto }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if (isset($notificacion->datos_adicionales['stock_actual']))
                                            <p><strong>Stock actual:</strong>
                                                {{ $notificacion->datos_adicionales['stock_actual'] }} unidades</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            @if (!$notificacion->leido)
                                <button wire:click="marcarComoLeida({{ $notificacion->id }})"
                                    class="text-gray-400 hover:text-gray-600" title="Marcar como leída">
                                    <x-heroicon-o-check class="w-4 h-4" />
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <x-heroicon-o-bell class="w-12 h-12 mx-auto text-gray-400" />
                    <p class="mt-2 text-sm text-gray-500">No hay notificaciones</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
