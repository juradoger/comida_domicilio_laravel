@extends('Layouts.cliente')

@section('title', 'Mis Calificaciones')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Mis Calificaciones</h2>

        @if (count($calificaciones) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($calificaciones as $calificacion)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Pedido #{{ $calificacion->id_pedido }}</h3>
                                    <p class="text-sm text-gray-600">{{ $calificacion->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $calificacion->calificacion ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            @if ($calificacion->empleado)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-1">Repartidor:</h4>
                                    <p class="text-gray-800">{{ $calificacion->empleado->name }}</p>
                                </div>
                            @endif

                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-1">Comentario:</h4>
                                <p class="text-gray-800 bg-gray-50 p-3 rounded">
                                    {{ $calificacion->comentario ?: 'Sin comentario' }}</p>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('cliente.pedidos.show', $calificacion->id_pedido) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm">
                                    Ver pedido
                                </a>

                                <span class="text-sm text-gray-600">
                                    {{ $calificacion->calificacion }}/5 estrellas
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4">No has realizado ninguna calificación.</p>
                <a href="{{ route('cliente.pedidos.index') }}"
                    class="inline-block bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold py-2 px-4 rounded hover:from-orange-600 hover:to-red-700 transition duration-300">
                    Ver mis pedidos entregados
                </a>
            </div>
        @endif
    </div>
@endsection
