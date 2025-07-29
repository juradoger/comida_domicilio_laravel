<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                🔔 Notificaciones
                @if ($this->getNotificacionesNoLeidas() > 0)
                    <span
                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $this->getNotificacionesNoLeidas() }} nuevas
                    </span>
                @endif
            </div>
        </x-slot>

        @if ($this->getNotificaciones()->count() > 0)
            <div class="space-y-3">
                @foreach ($this->getNotificaciones() as $notificacion)
                    <div
                        class="flex items-start gap-3 p-3 rounded-lg {{ $notificacion->leido ? 'bg-gray-50 dark:bg-gray-700' : 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500' }}">
                        <div class="flex-shrink-0 mt-1">
                            @if (!$notificacion->leido)
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @else
                                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p
                                class="text-sm {{ $notificacion->leido ? 'text-gray-600 dark:text-gray-400' : 'text-gray-900 dark:text-white font-medium' }}">
                                {{ $notificacion->mensaje }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $notificacion->fecha_envio->diffForHumans() }}
                            </p>
                        </div>

                        @if (!$notificacion->leido)
                            <div class="flex-shrink-0">
                                <x-filament::button size="xs" color="primary"
                                    wire:click="marcarComoLeida({{ $notificacion->id }})" wire:loading.attr="disabled">
                                    Marcar leída
                                </x-filament::button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if ($this->getNotificacionesNoLeidas() > 0)
                <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700 text-center">
                    <form action="{{ route('cliente.api.notificaciones.todas-leidas') }}" method="POST" class="inline">
                        @csrf
                        <x-filament::button size="sm" color="primary" type="submit">
                            Marcar todas como leídas
                        </x-filament::button>
                    </form>
                </div>
            @endif
        @else
            <div class="text-center py-6">
                <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                    🔔
                </div>
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">Sin notificaciones</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No tienes notificaciones nuevas.</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
