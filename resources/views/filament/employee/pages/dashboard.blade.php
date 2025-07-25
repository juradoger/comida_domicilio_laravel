<x-filament-panels::page>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Tarjeta de bienvenida -->
        <div class="col-span-full">
            <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    ¡Hola, {{ auth()->user()->name }}!
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Bienvenido al panel de empleados. Aquí puedes gestionar los pedidos y ver las estadísticas del día.
                </p>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="rounded-lg bg-blue-50 p-6 shadow dark:bg-blue-900/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pedidos Activos</h3>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                        {{ \App\Models\Pedido::whereIn('estado', ['pendiente', 'en_preparacion', 'en_camino'])->where('id_empleado', auth()->id())->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-green-50 p-6 shadow dark:bg-green-900/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Entregados Hoy</h3>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                        {{ \App\Models\Pedido::where('estado', 'entregado')->where('id_empleado', auth()->id())->whereDate('updated_at', today())->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-yellow-50 p-6 shadow dark:bg-yellow-900/20">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pendientes</h3>
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                        {{ \App\Models\Pedido::where('estado', 'pendiente')->where('id_empleado', auth()->id())->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Accesos Rápidos</h3>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('filament.employee.resources.pedidos.index') }}"
                class="block rounded-lg bg-white p-4 shadow transition hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="ml-3 font-medium text-gray-900 dark:text-white">Ver Pedidos</span>
                </div>
            </a>
        </div>
    </div>
</x-filament-panels::page>
