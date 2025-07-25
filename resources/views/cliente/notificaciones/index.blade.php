@extends('Layouts.cliente')

@section('title', 'Mis Notificaciones')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Mis Notificaciones</h2>
            <form action="{{ route('cliente.notificaciones.marcar-todas-leidas') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Marcar todas como leídas
                </button>
            </form>
        </div>
        
        @if(count($notificaciones) > 0)
            <div class="space-y-4">
                @foreach($notificaciones as $notificacion)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden {{ $notificacion->leida ? '' : 'border-l-4 border-blue-500' }}">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $notificacion->titulo }}</h3>
                                    <p class="text-sm text-gray-500">{{ $notificacion->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    @if(!$notificacion->leida)
                                        <form action="{{ route('cliente.notificaciones.marcar-leida', $notificacion->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Marcar como leída
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-green-600 text-sm font-medium">Leída</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <p class="text-gray-700">{{ $notificacion->mensaje }}</p>
                            </div>
                            
                            @if($notificacion->enlace)
                                <div class="mt-4">
                                    <a href="{{ route('cliente.notificaciones.show', $notificacion->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[var(--color-primario)] to-[var(--color-secundario)] text-white font-semibold rounded-lg shadow hover:from-[var(--color-secundario)] hover:to-[var(--color-primario)] transition-colors duration-200">
                                        Ver detalles
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $notificaciones->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600">No tienes notificaciones.</p>
            </div>
        @endif
    </div>
@endsection