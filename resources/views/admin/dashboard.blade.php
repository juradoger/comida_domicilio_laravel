@extends('Layouts.admin')

@section('title', 'Dashboard Administrador')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Administrador</h1>
    <p class="text-gray-600 mb-6">Bienvenido al panel de administración. Aquí puedes gestionar todos los aspectos del sistema de comida a domicilio.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Tarjeta de Pedidos -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold">Pedidos Totales</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalPedidos }}</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-blue-100">
                <span class="{{ $pedidosHoy > $pedidosAyer ? 'text-green-300' : 'text-red-300' }} font-semibold">{{ $pedidosHoy }}</span> pedidos hoy
            </div>
        </div>
        
        <!-- Tarjeta de Clientes -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold">Clientes</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalClientes }}</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-green-100">
                <span class="text-green-300 font-semibold">{{ $clientesNuevosMes }}</span> nuevos este mes
            </div>
        </div>
        
        <!-- Tarjeta de Empleados -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold">Empleados</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalEmpleados }}</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-purple-100">
                <span class="text-purple-300 font-semibold">{{ $promedioCalificacionEmpleados }}</span> calificación promedio
            </div>
        </div>
        
        <!-- Tarjeta de Ingresos -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold">Ingresos Totales</h3>
                    <p class="text-3xl font-bold mt-2">${{ number_format($ingresosTotales, 2) }}</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-orange-100">
                <span class="text-orange-300 font-semibold">${{ number_format($ingresosHoy, 2) }}</span> ingresos hoy
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Productos más vendidos -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Productos más vendidos</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendidos</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingresos</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($productosMasVendidos as $producto)
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">{{ $producto->nombre }}</td>
                            <td class="py-3 px-4 text-sm text-gray-500">{{ $producto->categoria->nombre }}</td>
                            <td class="py-3 px-4 text-sm text-gray-900">{{ $producto->cantidad_vendida }}</td>
                            <td class="py-3 px-4 text-sm text-gray-900">${{ number_format($producto->ingresos, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pedidos recientes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Pedidos recientes</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pedidosRecientes as $pedido)
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">#{{ $pedido->id }}</td>
                            <td class="py-3 px-4 text-sm text-gray-900">{{ $pedido->cliente->nombre }}</td>
                            <td class="py-3 px-4">
                                @if($pedido->estado == 'pendiente')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                                @elseif($pedido->estado == 'en_preparacion')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">En preparación</span>
                                @elseif($pedido->estado == 'en_camino')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">En camino</span>
                                @elseif($pedido->estado == 'entregado')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Entregado</span>
                                @elseif($pedido->estado == 'cancelado')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelado</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-900">${{ number_format($pedido->total, 2) }}</td>
                            <td class="py-3 px-4 text-sm text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('admin.pedidos.index') }}" class="text-orange-600 hover:text-orange-800 font-medium">Ver todos los pedidos →</a>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de pedidos por día de la semana -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Pedidos por día (Semana actual)</h3>
        <div class="h-80">
            <canvas id="pedidosPorDiaChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos para el gráfico de pedidos por día
        const pedidosPorDiaCtx = document.getElementById('pedidosPorDiaChart').getContext('2d');
        const pedidosPorDiaChart = new Chart(pedidosPorDiaCtx, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [{
                    label: 'Número de pedidos',
                    data: {{ json_encode(array_values($pedidosPorDia)) }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
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
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endpush