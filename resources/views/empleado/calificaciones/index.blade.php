@extends('Layouts.empleado')

@section('title', 'Mis Calificaciones')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Mis Calificaciones</h1>
        
        @if($empleado)
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">Repartidor</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $empleado->calificacion_promedio ?? 0 }}</div>
                    <div class="flex items-center justify-center mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($empleado->calificacion_promedio ?? 0))
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Calificación promedio</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($calificaciones->count() > 0)
        <div class="grid gap-6">
            @foreach($calificaciones as $calificacion)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $calificacion->calificacion)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                                <span class="ml-2 text-lg font-semibold text-gray-800">{{ $calificacion->calificacion }}/5</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">{{ $calificacion->created_at->format('d/m/Y H:i') }}</p>
                            <p class="text-sm text-gray-600">Pedido #{{ $calificacion->pedido->id }}</p>
                        </div>
                    </div>

                    @if($calificacion->comentario)
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <p class="text-gray-700 italic">"{{ $calificacion->comentario }}"</p>
                    </div>
                    @endif

                    <div class="border-t pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <p><span class="font-medium">Cliente:</span> {{ $calificacion->usuario->name }}</p>
                                <p><span class="font-medium">Fecha del pedido:</span> {{ $calificacion->pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p><span class="font-medium">Total:</span> Bs {{ number_format($calificacion->pedido->total, 2) }}</p>
                                <p><span class="font-medium">Estado:</span> {{ ucfirst(str_replace('_', ' ', $calificacion->pedido->estado)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600">Total de calificaciones: {{ $calificaciones->count() }}</p>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No tienes calificaciones aún</h3>
            <p class="text-gray-500">Cuando completes entregas, los clientes podrán calificar tu servicio.</p>
        </div>
    @endif
</div>
@endsection 