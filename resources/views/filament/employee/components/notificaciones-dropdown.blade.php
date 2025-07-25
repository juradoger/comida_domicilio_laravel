<div class="relative" x-data="{ open: false }">
    <!-- Botón de notificaciones -->
    <button @click="open = !open"
        class="relative inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>

        @if ($this->getNotificacionesNoLeidas() > 0)
            <span
                class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">
                {{ $this->getNotificacionesNoLeidas() }}
            </span>
        @endif
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-50 mt-2 w-80 bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-800 dark:divide-gray-600"
        style="display: none;">
        <!-- Header -->
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white border-b dark:border-gray-600">
            <div class="flex items-center justify-between">
                <span class="font-medium">Notificaciones</span>
                @if ($this->getNotificacionesNoLeidas() > 0)
                    <span
                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $this->getNotificacionesNoLeidas() }} nuevas
                    </span>
                @endif
            </div>
        </div>

        <!-- Lista de notificaciones -->
        <div class="max-h-96 overflow-y-auto">
            @forelse($this->getNotificaciones() as $notificacion)
                <div wire:key="notif-{{ $notificacion->id }}"
                    class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 {{ !$notificacion->leido ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                    <div class="flex-shrink-0">
                        @if (!$notificacion->leido)
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        @else
                            <div class="w-2 h-2 bg-gray-300 rounded-full mt-2"></div>
                        @endif
                    </div>

                    <div class="flex-1 ml-3">
                        <p
                            class="text-sm {{ $notificacion->leido ? 'text-gray-600 dark:text-gray-400' : 'text-gray-900 dark:text-white font-medium' }}">
                            {{ $notificacion->mensaje }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $notificacion->fecha_envio->diffForHumans() }}
                        </p>

                        @if (!$notificacion->leido)
                            <button wire:click="marcarComoLeida({{ $notificacion->id }})"
                                class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 mt-1">
                                Marcar como leída
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-4 py-6 text-center">
                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-5 5-5-5h5V3h0z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Sin notificaciones</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        @if ($this->getNotificacionesNoLeidas() > 0)
            <div class="px-4 py-3 border-t dark:border-gray-600">
                <button wire:click="marcarTodasComoLeidas"
                    class="w-full text-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium">
                    Marcar todas como leídas
                </button>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-refresh cada 30 segundos
    setInterval(() => {
        if (typeof Livewire !== 'undefined') {
            @this.call('$refresh');
        }
    }, 30000);

    // Escuchar eventos
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('notificacion-actualizada', () => {
            setTimeout(() => {
                @this.call('$refresh');
            }, 100);
        });

        Livewire.on('notificaciones-actualizadas', () => {
            setTimeout(() => {
                @this.call('$refresh');
            }, 100);
        });
    });
</script>
