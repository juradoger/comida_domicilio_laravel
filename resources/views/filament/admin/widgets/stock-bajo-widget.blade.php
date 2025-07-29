<x-filament-widgets::widget class="fi-wi-stock-bajo">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-exclamation-triangle text-red-500 text-sm"></i>
                    <span>Alerta de Stock Bajo</span>
                    @if ($this->getTotalProductosStockBajo() > 0 || $this->getTotalProductosSinStock() > 0)
                        <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                            {{ $this->getTotalProductosStockBajo() + $this->getTotalProductosSinStock() }}
                        </span>
                    @endif
                </div>
            </h3>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Productos con Stock Bajo -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Stock Bajo</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $this->getTotalProductosStockBajo() }}</p>
                    </div>
                    <div class="p-2 bg-orange-100 rounded-full">
                        <i class="fa-solid fa-exclamation-triangle text-orange-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Productos Sin Stock -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Sin Stock</p>
                        <p class="text-2xl font-bold text-red-600">{{ $this->getTotalProductosSinStock() }}</p>
                    </div>
                    <div class="p-2 bg-red-100 rounded-full">
                        <i class="fa-solid fa-times text-red-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Total Productos -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Productos</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $this->getTotalProductos() }}</p>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-full">
                        <i class="fa-solid fa-box text-blue-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Porcentaje de Alerta -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">% Alerta</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $this->getPorcentajeStockBajo() }}%</p>
                    </div>
                    <div class="p-2 bg-purple-100 rounded-full">
                        <i class="fa-solid fa-chart-pie text-purple-600 text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos con Stock Bajo -->
        @if ($this->getProductosStockBajo()->count() > 0)
            <div class="mb-8">
                <h4 class="text-md font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fa-solid fa-exclamation-triangle text-orange-500 text-sm mr-2"></i>
                    Productos con Stock Bajo (≤ 5 unidades)
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->getProductosStockBajo() as $producto)
                        <div class="bg-white rounded-lg shadow-sm border border-orange-200 p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <div class="flex-shrink-0">
                                            @if ($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                    alt="{{ $producto->nombre }}"
                                                    class="w-12 h-12 object-cover rounded-lg">
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-image text-gray-400 text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</h5>
                                            <p class="text-xs text-gray-500">
                                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                {{ $producto->stock }} unidades
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>Precio: Bs. {{ number_format($producto->precio, 2) }}</span>
                                        <span>ID: #{{ $producto->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Productos Sin Stock -->
        @if ($this->getProductosSinStock()->count() > 0)
            <div class="mb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fa-solid fa-times text-red-500 text-sm mr-2"></i>
                    Productos Sin Stock
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->getProductosSinStock() as $producto)
                        <div class="bg-white rounded-lg shadow-sm border border-red-200 p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <div class="flex-shrink-0">
                                            @if ($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                    alt="{{ $producto->nombre }}"
                                                    class="w-12 h-12 object-cover rounded-lg">
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="fa-solid fa-image text-gray-400 text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</h5>
                                            <p class="text-xs text-gray-500">
                                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Agotado
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>Precio: Bs. {{ number_format($producto->precio, 2) }}</span>
                                        <span>ID: #{{ $producto->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Mensaje cuando no hay alertas -->
        @if ($this->getProductosStockBajo()->count() === 0 && $this->getProductosSinStock()->count() === 0)
            <div class="text-center py-8">
                <i class="fa-solid fa-check-circle text-green-400 text-4xl mb-3"></i>
                <p class="text-gray-500">¡Excelente! No hay productos con stock bajo</p>
            </div>
        @endif
    </div>
</x-filament-widgets::widget>
