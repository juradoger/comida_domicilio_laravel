<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid gap-4 md:grid-cols-3">
            @if ($pedidos_pendientes > 0)
                <div
                    class="flex items-center p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900/20 dark:border-yellow-800">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-lg dark:bg-yellow-800/30">
                        <x-heroicon-o-clock class="w-6 h-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                            {{ $pedidos_pendientes }} Pedidos Pendientes
                        </h3>
                        <p class="text-xs text-yellow-600 dark:text-yellow-400">
                            Requieren atención inmediata
                        </p>
                    </div>
                </div>
            @endif

            @if ($productos_stock_bajo > 0)
                <div
                    class="flex items-center p-4 bg-red-50 border border-red-200 rounded-lg dark:bg-red-900/20 dark:border-red-800">
                    <div class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-lg dark:bg-red-800/30">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            {{ $productos_stock_bajo }} Productos con Stock Bajo
                        </h3>
                        <p class="text-xs text-red-600 dark:text-red-400">
                            Menos de 10 unidades disponibles
                        </p>
                    </div>
                </div>
            @endif

            @if ($pedidos_atrasados > 0)
                <div
                    class="flex items-center p-4 bg-orange-50 border border-orange-200 rounded-lg dark:bg-orange-900/20 dark:border-orange-800">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-orange-100 rounded-lg dark:bg-orange-800/30">
                        <x-heroicon-o-exclamation-circle class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-orange-800 dark:text-orange-200">
                            {{ $pedidos_atrasados }} Pedidos Atrasados
                        </h3>
                        <p class="text-xs text-orange-600 dark:text-orange-400">
                            Superaron el tiempo de entrega
                        </p>
                    </div>
                </div>
            @endif

            @if ($pedidos_pendientes == 0 && $productos_stock_bajo == 0 && $pedidos_atrasados == 0)
                <div
                    class="flex items-center p-4 bg-green-50 border border-green-200 rounded-lg dark:bg-green-900/20 dark:border-green-800 md:col-span-3">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg dark:bg-green-800/30">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-green-600 dark:text-green-400" />
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-green-800 dark:text-green-200">
                            Todo en orden
                        </h3>
                        <p class="text-xs text-green-600 dark:text-green-400">
                            No hay alertas pendientes en este momento
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
