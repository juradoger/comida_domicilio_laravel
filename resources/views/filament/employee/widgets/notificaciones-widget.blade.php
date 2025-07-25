<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span>Notificaciones</span>
                @if ($this->getNotificacionesNoLeidas() > 0)
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $this->getNotificacionesNoLeidas() }}
                    </span>
                @endif
            </div>
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getNotificaciones() as $notificacion)
                <div wire:key="notificacion-{{ $notificacion->id }}"
                    class="flex items-start space-x-3 p-3 rounded-lg transition-colors duration-200 {{ $notificacion->leido ? 'bg-gray-50 dark:bg-gray-800' : 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500' }}">
                    <div class="flex-shrink-0">
                        @if (!$notificacion->leido)
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        @else
                            <div class="w-2 h-2 bg-gray-300 rounded-full mt-2"></div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p
                            class="text-sm {{ $notificacion->leido ? 'text-gray-600 dark:text-gray-400' : 'text-gray-900 dark:text-gray-100 font-medium' }}">
                            {{ $notificacion->mensaje }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ $notificacion->fecha_envio->diffForHumans() }}
                        </p>
                    </div>

                    @if (!$notificacion->leido)
                        <div class="flex-shrink-0">
                            <button wire:click="marcarComoLeida({{ $notificacion->id }})"
                                class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                                Marcar leída
                            </button>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-5 5-5-5h5V3h0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Sin notificaciones</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No tienes notificaciones nuevas.</p>
                </div>
            @endforelse
        </div>

        @if ($this->getNotificacionesNoLeidas() > 0)
            <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                <button wire:click="marcarTodasComoLeidas"
                    class="w-full text-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    Marcar todas como leídas
                </button>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>

<script>
    // Auto-refresh cada 30 segundos
    setInterval(() => {
        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch('$refresh');
        }
    }, 30000);

    // Escuchar eventos de notificaciones marcadas
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('notificacion-marcada', () => {
            setTimeout(() => {
                Livewire.dispatch('$refresh');
            }, 100);
        });

        Livewire.on('todas-notificaciones-marcadas', () => {
            setTimeout(() => {
                Livewire.dispatch('$refresh');
            }, 100);
        });
    });
</script>
