<x-filament-widgets::widget>
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                Mis Calificaciones
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Calificación Promedio -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Calificación Promedio</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $this->getCalificacionPromedio() }}</p>
                    </div>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $this->getCalificacionPromedio())
                                <i class="fa-solid fa-star text-yellow-400 text-sm"></i>
                            @else
                                <i class="fa-regular fa-star text-gray-300 text-sm"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Total de Calificaciones -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Calificaciones</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $this->getTotalCalificaciones() }}</p>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-full">
                        <i class="fa-solid fa-star text-blue-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Calificaciones Recientes -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Últimos 30 días</p>
                        <p class="text-3xl font-bold text-green-600">{{ $this->getCalificacionesRecientes() }}</p>
                    </div>
                    <div class="p-2 bg-green-100 rounded-full">
                        <i class="fa-solid fa-clock text-green-600 text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calificaciones Recientes -->
        <div class="space-y-4 mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Calificaciones Recientes</h3>
            
            @if($this->getCalificaciones()->count() > 0)
                @foreach($this->getCalificaciones() as $calificacion)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $calificacion->calificacion)
                                                <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                            @else
                                                <i class="fa-regular fa-star text-gray-300 text-xs"></i>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm font-medium text-gray-900">{{ $calificacion->calificacion }}/5</span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $calificacion->created_at->diffForHumans() }}</span>
                                </div>
                                
                                @if($calificacion->comentario)
                                    <p class="text-sm text-gray-700 italic mb-2">"{{ $calificacion->comentario }}"</p>
                                @endif
                                
                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                    <span>Cliente: {{ $calificacion->usuario->name }}</span>
                                    <span>Pedido #{{ $calificacion->pedido->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <i class="fa-solid fa-star text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">No tienes calificaciones aún</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget> 