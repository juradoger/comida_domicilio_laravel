@extends('Layouts.cliente')

@section('title', 'Detalle de Notificación')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Detalle de Notificación</h2>
            <a href="{{ route('cliente.notificaciones.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Notificaciones
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="border-b pb-4 mb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-bold text-gray-800">{{ $notificacion->titulo }}</h3>
                        <span class="text-sm text-gray-500">{{ $notificacion->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                
                <div class="prose max-w-none">
                    <p class="text-gray-700">{{ $notificacion->mensaje }}</p>
                </div>
                
                @if($notificacion->enlace)
                    <div class="mt-6">
                        <a href="{{ $notificacion->enlace }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Ver contenido relacionado
                        </a>
                    </div>
                @endif
                
                @if(!$notificacion->leida)
                    <div class="mt-6 border-t pt-4">
                        <form action="{{ route('cliente.notificaciones.marcar-leida', $notificacion->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                Marcar como leída
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection