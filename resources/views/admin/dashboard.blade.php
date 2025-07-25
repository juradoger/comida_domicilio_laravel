@extends('Layouts.admin')
@section('title', 'Dashboard Administrador')

@section('content')
<div class="fade-in-up">
    <!-- Header con bienvenida personalizada -->
    <div class="glass-card mb-8 p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[var(--color-primario)] to-[var(--color-secundario)] opacity-10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10">
            <h1 class="font-heading text-3xl md:text-4xl font-bold mb-2 text-[var(--color-primario)]">Dashboard Administrador</h1>
            <p class="font-sans text-gray-600 mb-4">Bienvenido <span class="font-cursive text-[var(--color-enfasis)] text-xl">{{ Auth::user()->name }}</span>, aquí puedes gestionar todos los aspectos del sistema.</p>
            
            <div class="flex flex-wrap gap-4 mt-6">
                <a href="{{ route('admin.pedidos.index') }}" class="btn-shimmer bg-[var(--color-primario)] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Ver Pedidos
                </a>
                <a href="{{ route('productos.index') }}" class="btn-shimmer bg-[var(--color-enfasis)] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                    Gestionar Productos
                </a>
                <a href="{{ route('admin.estadisticas') }}" class="btn-shimmer bg-[var(--color-acento)] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Ver Estadísticas
                </a>
            </div>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Tarjeta de Pedidos -->
        <div class="stat-card bg-gradient-to-br from-[var(--color-primario)] to-[var(--color-secundario)] rounded-xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-heading font-semibold">Pedidos Totales</h3>
                    <p class="text-3xl font-bold mt-2 font-sans">{{ $totalPedidos ?? '0' }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-white text-opacity-90">
                <span class="text-green-300 font-semibold">{{ $pedidosHoy ?? '0' }}</span> pedidos hoy
            </div>
        </div>
        
        <!-- Tarjeta de Clientes -->
        <div class="stat-card bg-gradient-to-br from-[var(--color-enfasis)] to-[#238a7a] rounded-xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-heading font-semibold">Clientes</h3>
                    <p class="text-3xl font-bold mt-2 font-sans">{{ $totalClientes ?? '0' }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-white text-opacity-90">
                <span class="text-green-300 font-semibold">{{ $clientesNuevosMes ?? '0' }}</span> nuevos este mes
            </div>
        </div>
        
        <!-- Tarjeta de Empleados -->
        <div class="stat-card bg-gradient-to-br from-[var(--color-acento)] to-[#e09145] rounded-xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-heading font-semibold">Empleados</h3>
                    <p class="text-3xl font-bold mt-2 font-sans">{{ $totalEmpleados ?? '0' }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-white text-opacity-90">
                <span class="text-green-300 font-semibold">{{ $promedioCalificacionEmpleados ?? '4.5' }}</span> calificación promedio
            </div>
        </div>
        
        <!-- Tarjeta de Ingresos -->
        <div class="stat-card bg-gradient-to-br from-[var(--color-texto)] to-[#555555] rounded-xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-heading font-semibold">Ingresos Totales</h3>
                    <p class="text-3xl font-bold mt-2 font-sans">${{ number_format($ingresosTotales ?? 0, 2) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-white text-opacity-90">
                <span class="text-green-300 font-semibold">${{ number_format($ingresosHoy ?? 0, 2) }}</span> ingresos hoy
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Productos más vendidos -->
        <div class="glass-card p-6 fade-in-up animation-delay-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-heading font-bold text-[var(--color-primario)]">Productos más vendidos</h3>
                <a href="{{ route('productos.index') }}" class="text-[var(--color-enfasis)] hover:text-[var(--color-primario)] transition-colors flex items-center gap-1 text-sm font-medium">
                    Ver todos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendidos</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingresos</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if(isset($productosMasVendidos) && $productosMasVendidos->count() > 0)
                            @foreach($productosMasVendidos as $producto)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    <span class="px-2 py-1 bg-[var(--color-enfasis)] bg-opacity-10 text-[var(--color-enfasis)] rounded-full">
                                        {{ $producto->cantidad_vendida ?? 0 }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm font-medium text-[var(--color-primario)]">${{ number_format($producto->ingresos ?? 0, 2) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                    </svg>
                                    No hay datos de productos disponibles
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pedidos recientes -->
        <div class="glass-card p-6 fade-in-up animation-delay-500">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-heading font-bold text-[var(--color-primario)]">Pedidos recientes</h3>
                <a href="{{ route('admin.pedidos.index') }}" class="text-[var(--color-enfasis)] hover:text-[var(--color-primario)] transition-colors flex items-center gap-1 text-sm font-medium">
                    Ver todos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if(isset($pedidosRecientes) && $pedidosRecientes->count() > 0)
                            @foreach($pedidosRecientes as $pedido)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-sm font-medium text-gray-900">#{{ $pedido->id }}</td>
                                <td class="py-3 px-4 text-sm text-gray-900">{{ $pedido->cliente->nombre ?? 'Cliente desconocido' }}</td>
                                <td class="py-3 px-4">
                                    @if($pedido->estado == 'pendiente')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                                    @elseif($pedido->estado == 'en_preparacion')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">En preparación</span>
                                    @elseif($pedido->estado == 'en_camino')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">En camino</span>
                                    @elseif($pedido->estado == 'entregado')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Entregado</span>
                                    @elseif($pedido->estado == 'cancelado')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelado</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm font-medium text-[var(--color-primario)]">${{ number_format($pedido->total ?? 0, 2) }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    No hay pedidos recientes
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de pedidos por día de la semana -->
    <div class="glass-card p-6 mb-6 fade-in-up animation-delay-700">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-heading font-bold text-[var(--color-primario)]">Pedidos por día (Semana actual)</h3>
            <div class="flex gap-2">
                <button id="toggleChartType" class="text-[var(--color-enfasis)] hover:text-[var(--color-primario)] transition-colors flex items-center gap-1 text-sm font-medium px-3 py-1 border border-[var(--color-enfasis)] rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                    Cambiar gráfico
                </button>
            </div>
        </div>
        <div class="h-80">
            <canvas id="pedidosPorDiaChart"></canvas>
        </div>
    </div>

    <!-- Resumen de actividad reciente -->
    <div class="glass-card p-6 mb-6 fade-in-up animation-delay-900">
        <h3 class="text-xl font-heading font-bold text-[var(--color-primario)] mb-6">Actividad reciente</h3>
        
        <div class="space-y-4">
            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="bg-[var(--color-primario)] bg-opacity-10 p-3 rounded-full">
                    <svg class="w-6 h-6 text-[var(--color-primario)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Se han registrado <span class="text-[var(--color-primario)] font-bold">{{ $pedidosHoy ?? '0' }}</span> nuevos pedidos hoy</p>
                    <p class="text-gray-500 text-sm">Valor total: ${{ number_format($ingresosHoy ?? 0, 2) }}</p>
                </div>
                <span class="text-xs text-gray-400">Hoy</span>
            </div>
            
            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="bg-[var(--color-enfasis)] bg-opacity-10 p-3 rounded-full">
                    <svg class="w-6 h-6 text-[var(--color-enfasis)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Se han registrado <span class="text-[var(--color-enfasis)] font-bold">{{ $clientesNuevosMes ?? '0' }}</span> nuevos clientes este mes</p>
                    <p class="text-gray-500 text-sm">Total de clientes: {{ $totalClientes ?? '0' }}</p>
                </div>
                <span class="text-xs text-gray-400">Este mes</span>
            </div>
            
            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="bg-[var(--color-acento)] bg-opacity-10 p-3 rounded-full">
                    <svg class="w-6 h-6 text-[var(--color-acento)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Sistema funcionando correctamente</p>
                    <p class="text-gray-500 text-sm">Todos los servicios operativos</p>
                </div>
                <span class="text-xs text-gray-400">Ahora</span>
            </div>
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
        
        // Datos de ejemplo si no existen
        const pedidosData = @json($pedidosPorDia ?? [0, 0, 0, 0, 0, 0, 0]);
        
        // Configuración inicial como gráfico de barras
        let chartType = 'bar';
        let chartConfig = {
            type: chartType,
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [{
                    label: 'Número de pedidos',
                    data: Object.values(pedidosData),
                    backgroundColor: [
                        '#c1272d80',
                        '#e6394680',
                        '#f4a26180',
                        '#c1272d80',
                        '#e6394680',
                        '#f4a26180',
                        '#c1272d80'
                    ],
                    borderColor: [
                        '#c1272d',
                        '#e63946',
                        '#f4a261',
                        '#c1272d',
                        '#e63946',
                        '#f4a261',
                        '#c1272d'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#c1272d',
                        bodyColor: '#333',
                        bodyFont: {
                            family: "'Inter', sans-serif"
                        },
                        titleFont: {
                            family: "'Playfair Display', serif",
                            weight: 'bold'
                        },
                        borderColor: '#c1272d',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return `Pedidos: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        };
        
        const pedidosPorDiaChart = new Chart(pedidosPorDiaCtx, chartConfig);
        
        // Cambiar tipo de gráfico al hacer clic en el botón
        document.getElementById('toggleChartType')?.addEventListener('click', function() {
            // Alternar entre bar y line
            chartType = chartType === 'bar' ? 'line' : 'bar';
            
            // Destruir el gráfico actual
            pedidosPorDiaChart.destroy();
            
            // Actualizar configuración
            chartConfig.type = chartType;
            
            // Si es línea, ajustar algunas opciones
            if (chartType === 'line') {
                chartConfig.data.datasets[0].fill = true;
                chartConfig.data.datasets[0].backgroundColor = '#c1272d20';
                chartConfig.data.datasets[0].borderColor = '#c1272d';
                chartConfig.data.datasets[0].pointBackgroundColor = '#e63946';
            } else {
                // Restaurar colores originales para barras
                chartConfig.data.datasets[0].backgroundColor = [
                    '#c1272d80',
                    '#e6394680',
                    '#f4a26180',
                    '#c1272d80',
                    '#e6394680',
                    '#f4a26180',
                    '#c1272d80'
                ];
                chartConfig.data.datasets[0].borderColor = [
                    '#c1272d',
                    '#e63946',
                    '#f4a261',
                    '#c1272d',
                    '#e63946',
                    '#f4a261',
                    '#c1272d'
                ];
            }
            
            // Crear nuevo gráfico con la configuración actualizada
            new Chart(pedidosPorDiaCtx, chartConfig);
        });
    });
</script>
@endpush
