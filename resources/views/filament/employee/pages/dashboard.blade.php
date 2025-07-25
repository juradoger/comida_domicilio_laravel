@php
    $empleado = \App\Models\Empleado::where('id_usuario', auth()->id())->first();
    $empleadoId = $empleado ? $empleado->id : null;
@endphp

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
                        {{ $empleadoId? \App\Models\Pedido::whereIn('estado', ['pendiente', 'en_preparacion', 'en_camino'])->where('id_empleado', $empleadoId)->count(): 0 }}
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
                        {{ $empleadoId ? \App\Models\Pedido::where('estado', 'entregado')->where('id_empleado', $empleadoId)->whereDate('updated_at', today())->count() : 0 }}
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
                        {{ $empleadoId ? \App\Models\Pedido::where('estado', 'pendiente')->where('id_empleado', $empleadoId)->count() : 0 }}
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

    <!-- Sección de Notificaciones -->
    <div class="mt-6">
        <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    🔔 Tus Notificaciones
                </h3>
                @php
                    $notificacionesNoLeidas = \App\Models\Notificacion::where('id_usuario', auth()->id())
                        ->where('leido', false)
                        ->count();
                @endphp
                @if ($notificacionesNoLeidas > 0)
                    <span
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $notificacionesNoLeidas }} nuevas
                    </span>
                @endif
            </div>

            @php
                $notificaciones = \App\Models\Notificacion::where('id_usuario', auth()->id())
                    ->orderBy('fecha_envio', 'desc')
                    ->limit(8)
                    ->get();
            @endphp

            @if ($notificaciones->count() > 0)
                <div class="space-y-3">
                    @foreach ($notificaciones as $notificacion)
                        <div
                            class="flex items-start space-x-3 p-4 rounded-lg transition-colors duration-200 {{ $notificacion->leido ? 'bg-gray-50 dark:bg-gray-700' : 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500' }}">
                            <div class="flex-shrink-0 mt-1">
                                @if (!$notificacion->leido)
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                @else
                                    <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
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
                                    <form method="POST"
                                        action="{{ route('cliente.api.notificaciones.leida', $notificacion->id) }}"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium px-2 py-1 rounded hover:bg-blue-100 dark:hover:bg-blue-800">
                                            Marcar leída
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if ($notificacionesNoLeidas > 0)
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <form method="POST" action="{{ route('cliente.api.notificaciones.todas-leidas') }}"
                            class="inline">
                            @csrf
                            <button type="submit"
                                class="w-full text-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 font-medium py-2 px-4 rounded hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors">
                                ✅ Marcar todas como leídas
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 17h5l-5 5-5-5h5V3h0z" />
                    </svg>
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Sin notificaciones</h4>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No tienes notificaciones nuevas por el
                        momento.</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
