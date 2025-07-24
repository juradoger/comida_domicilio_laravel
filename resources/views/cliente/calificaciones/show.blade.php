@extends('Layouts.cliente')

@section('title', 'Detalles de Calificación')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Detalles de Calificación</h2>
            <a href="{{ route('cliente.calificaciones.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Calificaciones
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Información de la Calificación</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">ID:</span>
                                <span class="text-gray-800">{{ $calificacion->id }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Puntuación:</span>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $calificacion->puntuacion ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Fecha:</span>
                                <span class="text-gray-800">{{ $calificacion->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="text-md font-bold text-gray-700 mb-2">Comentario:</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="text-gray-800">{{ $calificacion->comentario ?: 'Sin comentario' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Información del Pedido</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Pedido ID:</span>
                                <a href="{{ route('cliente.pedidos.show', $calificacion->pedido_id) }}" class="text-indigo-600 hover:text-indigo-900">
                                    #{{ $calificacion->pedido_id }}
                                </a>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Estado del Pedido:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($calificacion->pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                    @elseif($calificacion->pedido->estado == 'en_proceso') bg-blue-100 text-blue-800
                                    @elseif($calificacion->pedido->estado == 'en_camino') bg-indigo-100 text-indigo-800
                                    @elseif($calificacion->pedido->estado == 'entregado') bg-green-100 text-green-800
                                    @elseif($calificacion->pedido->estado == 'cancelado') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $calificacion->pedido->estado)) }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Fecha de Entrega:</span>
                                <span class="text-gray-800">{{ $calificacion->pedido->fecha_entrega ? date('d/m/Y H:i', strtotime($calificacion->pedido->fecha_entrega)) : 'Pendiente' }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="text-md font-bold text-gray-700 mb-2">Información del Repartidor:</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <p><span class="font-medium">Nombre:</span> {{ $calificacion->empleado->user->name }}</p>
                                <p><span class="font-medium">Correo:</span> {{ $calificacion->empleado->user->email }}</p>
                                <p><span class="font-medium">Teléfono:</span> {{ $calificacion->empleado->telefono ?: 'No disponible' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 border-t pt-4">
                    <div class="flex justify-end">
                        <a href="{{ route('cliente.calificaciones.edit', $calificacion->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 mr-2">
                            Editar Calificación
                        </a>
                        <form action="{{ route('cliente.calificaciones.destroy', $calificacion->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300" onclick="return confirm('¿Estás seguro de eliminar esta calificación?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection