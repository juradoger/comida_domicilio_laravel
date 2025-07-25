@extends('Layouts.cliente')

@section('title', 'Historial de Compras')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Historial de Compras</h2>
            <div class="flex space-x-2">
                <div class="relative">
                    <input type="text" id="buscar" placeholder="Buscar por restaurante o producto"
                        class="w-64 rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 pl-10">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <select id="filtroFecha"
                    class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    <option value="">Todas las fechas</option>
                    <option value="7">Últimos 7 días</option>
                    <option value="30">Últimos 30 días</option>
                    <option value="90">Últimos 3 meses</option>
                    <option value="365">Último año</option>
                </select>
            </div>
        </div>

        <!-- Resumen de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                        <i class="fas fa-shopping-bag text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total de Pedidos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $estadisticas['total_pedidos'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Gastado</p>
                        <p class="text-2xl font-bold text-gray-800">Bs
                            {{ number_format($estadisticas['total_gastado'], 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                        <i class="fas fa-utensils text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Restaurante Favorito</p>
                        <p class="text-lg font-bold text-gray-800">
                            {{ $estadisticas['restaurante_favorito'] ?: 'Sin datos' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                        <i class="fas fa-hamburger text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Producto Más Pedido</p>
                        <p class="text-lg font-bold text-gray-800">{{ $estadisticas['producto_favorito'] ?: 'Sin datos' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de compras por mes -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Compras por Mes</h3>
            <div class="h-64">
                <canvas id="comprasPorMes"></canvas>
            </div>
        </div>

        <!-- Historial de pedidos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Historial Detallado</h3>
            </div>

            @if (count($pedidos) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pedido</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Restaurante</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Productos</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="historialTable">
                            @foreach ($pedidos as $pedido)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-medium text-gray-900">#{{ $pedido->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $pedido->created_at->format('d/m/Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $pedido->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $pedido->restaurante->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @foreach ($pedido->detalles->take(2) as $detalle)
                                                <div>{{ $detalle->cantidad }}x {{ $detalle->producto->nombre }}</div>
                                            @endforeach
                                            @if ($pedido->detalles->count() > 2)
                                                <div class="text-gray-500 text-xs">+{{ $pedido->detalles->count() - 2 }}
                                                    más</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Bs
                                            {{ number_format($pedido->total, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($pedido->estado == 'en_proceso') bg-blue-100 text-blue-800
                                            @elseif($pedido->estado == 'en_camino') bg-indigo-100 text-indigo-800
                                            @elseif($pedido->estado == 'entregado') bg-green-100 text-green-800
                                            @elseif($pedido->estado == 'cancelado') bg-red-100 text-red-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('cliente.pedidos.show', $pedido->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                        @if ($pedido->estado == 'entregado')
                                            <a href="{{ route('cliente.pedidos.repetir', $pedido->id) }}"
                                                class="text-green-600 hover:text-green-900">Repetir</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pedidos->links() }}
                </div>
            @else
                <div class="p-6 text-center">
                    <p class="text-gray-600 mb-4">No tienes pedidos en tu historial.</p>
                    <a href="{{ route('cliente.menu') }}"
                        class="inline-block bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold py-2 px-4 rounded hover:from-orange-600 hover:to-red-700 transition duration-300">
                        Explorar Menú
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gráfico de compras por mes
                const ctx = document.getElementById('comprasPorMes').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($grafico['meses']) !!},
                        datasets: [{
                            label: 'Total de Compras (Bs)',
                            data: {!! json_encode($grafico['totales']) !!},
                            backgroundColor: 'rgba(234, 88, 12, 0.6)',
                            borderColor: 'rgba(234, 88, 12, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Bs ' + value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Filtrado de la tabla
                const buscarInput = document.getElementById('buscar');
                const filtroFecha = document.getElementById('filtroFecha');
                const historialTable = document.getElementById('historialTable');
                const filas = historialTable.querySelectorAll('tr');

                function filtrarTabla() {
                    const textoBusqueda = buscarInput.value.toLowerCase();
                    const diasFiltro = filtroFecha.value ? parseInt(filtroFecha.value) : 0;
                    const fechaLimite = diasFiltro ? new Date(Date.now() - diasFiltro * 24 * 60 * 60 * 1000) : null;

                    filas.forEach(fila => {
                        const restaurante = fila.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const productos = fila.querySelector('td:nth-child(4)').textContent.toLowerCase();
                        const fechaTexto = fila.querySelector('td:nth-child(2) div:first-child').textContent;
                        const fechaParts = fechaTexto.split('/');
                        const fecha = new Date(fechaParts[2], fechaParts[1] - 1, fechaParts[0]);

                        const coincideTexto = restaurante.includes(textoBusqueda) || productos.includes(
                            textoBusqueda);
                        const coincideFecha = !fechaLimite || fecha >= fechaLimite;

                        if (coincideTexto && coincideFecha) {
                            fila.style.display = '';
                        } else {
                            fila.style.display = 'none';
                        }
                    });
                }

                buscarInput.addEventListener('input', filtrarTabla);
                filtroFecha.addEventListener('change', filtrarTabla);
            });
        </script>
    @endpush
@endsection
