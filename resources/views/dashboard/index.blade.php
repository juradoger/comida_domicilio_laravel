@extends('Layouts.admin')

@section('title', 'Panel de Control - FastBite')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-8">Panel de Control</h1>

        <!-- Tarjetas de estadísticas principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Pedidos Hoy -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1">Pedidos Hoy</h2>
                        <p class="text-4xl font-bold text-gray-800">{{ $pedidosHoy }}</p>
                        <p class="text-sm text-orange-500 mt-2">Pedidos realizados hoy <span class="inline-block ml-1"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg></span></p>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-orange-500 h-full rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>

            <!-- Ventas del Día -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1">Ventas del Día</h2>
                        <p class="text-4xl font-bold text-gray-800">Bs {{ number_format($ventasDelDia, 2) }}</p>
                        <p class="text-sm text-green-500 mt-2">Ingresos de hoy (bolivianos) <span
                                class="inline-block ml-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg></span></p>
                    </div>
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-green-500 h-full rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <!-- Total Usuarios -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1">Total Usuarios</h2>
                        <p class="text-4xl font-bold text-gray-800">{{ $totalUsuarios }}</p>
                        <p class="text-sm text-blue-500 mt-2">Usuarios registrados <span class="inline-block ml-1"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg></span></p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-blue-500 h-full rounded-full" style="width: 80%"></div>
                    </div>
                </div>
            </div>

            <!-- Stock Bajo -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-gray-500 text-sm font-semibold mb-1">Stock Bajo</h2>
                        <p class="text-4xl font-bold text-gray-800">{{ $stockBajo }}</p>
                        <p class="text-sm text-red-500 mt-2">Productos con poco stock <span class="inline-block ml-1"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg></span></p>
                    </div>
                    <div class="bg-red-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-red-500 h-full rounded-full" style="width: {{ min($stockBajo * 10, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos y Tablas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Pedidos por Mes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Pedidos por Mes</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full h-full flex items-end justify-between space-x-2">
                        @php
                            $meses = [
                                'Ene',
                                'Feb',
                                'Mar',
                                'Abr',
                                'May',
                                'Jun',
                                'Jul',
                                'Ago',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dic',
                            ];
                            $valores = [5, 8, 12, 10, 15, 18, 20, 22, 25, 23, 20, 18]; // Datos de ejemplo
                            $max = max($valores);
                        @endphp

                        @foreach ($meses as $index => $mes)
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 rounded-t-sm w-6"
                                    style="height: {{ ($valores[$index] / $max) * 100 }}%"></div>
                                <span class="text-xs mt-1 text-gray-500">{{ $mes }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Pedidos</span>
                </div>
            </div>

            <!-- Estado de Pedidos -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Estado de Pedidos</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full max-w-xs">
                        <div class="relative h-64 w-64 mx-auto">
                            <svg viewBox="0 0 36 36" class="w-full h-full">
                                <!-- Gráfico circular con colores para cada estado -->
                                @php
                                    $estados = [
                                        'pendiente' => [
                                            'color' => '#F59E0B',
                                            'porcentaje' => $estadoPedidos['pendiente'] ?? 0,
                                        ],
                                        'aceptado' => [
                                            'color' => '#8B5CF6',
                                            'porcentaje' => $estadoPedidos['aceptado'] ?? 0,
                                        ],
                                        'en_camino' => [
                                            'color' => '#3B82F6',
                                            'porcentaje' => $estadoPedidos['en_camino'] ?? 0,
                                        ],
                                        'entregado' => [
                                            'color' => '#10B981',
                                            'porcentaje' => $estadoPedidos['entregado'] ?? 0,
                                        ],
                                        'cancelado' => [
                                            'color' => '#EF4444',
                                            'porcentaje' => $estadoPedidos['cancelado'] ?? 0,
                                        ],
                                    ];

                                    $total = array_sum(array_column($estados, 'porcentaje'));
                                    $total = $total > 0 ? $total : 1; // Evitar división por cero

                                    $acumulado = 0;
                                @endphp

                                @foreach ($estados as $estado => $info)
                                    @php
                                        $porcentaje = ($info['porcentaje'] / $total) * 100;
                                        $inicio = $acumulado * 3.6; // 3.6 grados por cada 1%
                                        $fin = ($acumulado + $porcentaje) * 3.6;
                                        $acumulado += $porcentaje;

                                        // Calcular coordenadas para el arco SVG
                                        $x1 = 18 + 16 * sin(deg2rad($inicio));
                                        $y1 = 18 - 16 * cos(deg2rad($inicio));
                                        $x2 = 18 + 16 * sin(deg2rad($fin));
                                        $y2 = 18 - 16 * cos(deg2rad($fin));
                                        $largeArcFlag = $porcentaje > 50 ? 1 : 0;
                                    @endphp

                                    @if ($porcentaje > 0)
                                        <path
                                            d="M 18 18 L {{ $x1 }} {{ $y1 }} A 16 16 0 {{ $largeArcFlag }} 1 {{ $x2 }} {{ $y2 }} Z"
                                            fill="{{ $info['color'] }}" />
                                    @endif
                                @endforeach

                                <!-- Círculo central para efecto donut -->
                                <circle cx="18" cy="18" r="10" fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    @foreach ($estados as $estado => $info)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs"
                            style="background-color: {{ $info['color'] }}25; color: {{ $info['color'] }}">
                            <span class="w-2 h-2 rounded-full mr-1"
                                style="background-color: {{ $info['color'] }}"></span>
                            {{ ucfirst(str_replace('_', ' ', $estado)) }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Ingresos Mensuales -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ingresos Mensuales</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full h-full">
                        @php
                            $meses = [
                                'Ene',
                                'Feb',
                                'Mar',
                                'Abr',
                                'May',
                                'Jun',
                                'Jul',
                                'Ago',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dic',
                            ];
                            $valores = [];

                            // Convertir datos de ingresos mensuales a formato para gráfico
                            for ($i = 1; $i <= 12; $i++) {
                                $valores[] = $ingresosMensuales[$i] ?? 0;
                            }

                            $max = max($valores) > 0 ? max($valores) : 1;
                            $puntos = [];

                            foreach ($valores as $index => $valor) {
                                $x = $index * (100 / 11); // 11 espacios para 12 puntos
                                $y = 100 - ($valor / $max) * 100;
                                $puntos[] = "$x,$y";
                            }

                            $puntosStr = implode(' ', $puntos);
                        @endphp

                        <svg viewBox="0 0 100 100" class="w-full h-full" preserveAspectRatio="none">
                            <!-- Línea de gráfico -->
                            <polyline points="{{ $puntosStr }}" fill="none" stroke="#10B981" stroke-width="2"
                                vector-effect="non-scaling-stroke" />

                            <!-- Área bajo la curva -->
                            <polyline points="0,100 {{ $puntosStr }} 100,100" fill="rgba(16, 185, 129, 0.1)"
                                stroke="none" />

                            <!-- Puntos en la línea -->
                            @foreach ($puntos as $index => $punto)
                                @php
                                    [$x, $y] = explode(',', $punto);
                                @endphp
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="1" fill="#10B981" />
                            @endforeach
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex justify-between text-xs text-gray-500">
                    @foreach ($meses as $mes)
                        <span>{{ $mes }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Productos Más Vendidos -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Productos Más Vendidos</h2>
                @if (count($productosMasVendidos) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Producto</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Categoría</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ventas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productosMasVendidos as $detalle)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $detalle->producto->imagen) }}"
                                                        alt="{{ $detalle->producto->nombre }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $detalle->producto->nombre }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $detalle->producto->categoria->nombre }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $detalle->total_vendido }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Bs
                                                {{ number_format($detalle->total_vendido * $detalle->producto->precio, 2) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="mt-2 text-gray-500">No hay datos de ventas disponibles</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Aquí puedes agregar JavaScript para gráficos interactivos si lo deseas
        // Por ejemplo, usando Chart.js o ApexCharts
    </script>
@endsection
