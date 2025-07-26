<x-filament-widgets::widget>

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
