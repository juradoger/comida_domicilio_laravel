@extends('Layouts.cliente')

@section('title', 'Sesiones Activas')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Sesiones Activas</h2>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Estas son las sesiones activas en tu cuenta. Puedes cerrar cualquier sesión que no reconozcas o que ya no necesites.</p>
                    
                    <div class="space-y-6">
                        <!-- Sesión actual -->
                        <div class="border border-green-200 bg-green-50 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 bg-green-100 text-green-500 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $sesionActual->dispositivo }} <span class="text-sm font-normal text-green-600 ml-2">(Sesión actual)</span></h4>
                                            <p class="text-sm text-gray-500">{{ $sesionActual->navegador }} - {{ $sesionActual->sistema_operativo }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Última actividad: {{ $sesionActual->ultima_actividad->diffForHumans() }}</p>
                                        <p class="text-sm text-gray-500">Ubicación: {{ $sesionActual->ubicacion }}</p>
                                        <p class="text-sm text-gray-500">Dirección IP: {{ $sesionActual->ip }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Otras sesiones -->
                        @forelse($sesiones as $sesion)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 bg-gray-100 text-gray-500 rounded-full flex items-center justify-center">
                                            @if(Str::contains($sesion->dispositivo, 'Mobile'))
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            @elseif(Str::contains($sesion->dispositivo, 'Tablet'))
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-800">{{ $sesion->dispositivo }}</h4>
                                                <p class="text-sm text-gray-500">{{ $sesion->navegador }} - {{ $sesion->sistema_operativo }}</p>
                                            </div>
                                            <form action="{{ route('cliente.configuracion.sesiones.cerrar', $sesion->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition duration-300">
                                                    Cerrar Sesión
                                                </button>
                                            </form>
                                        </div>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">Última actividad: {{ $sesion->ultima_actividad->diffForHumans() }}</p>
                                            <p class="text-sm text-gray-500">Ubicación: {{ $sesion->ubicacion }}</p>
                                            <p class="text-sm text-gray-500">Dirección IP: {{ $sesion->ip }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-gray-500">No hay otras sesiones activas en tu cuenta.</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-8">
                        <form action="{{ route('cliente.configuracion.sesiones.cerrar-todas') }}" method="POST" onsubmit="return confirm('¿Estás seguro de cerrar todas las demás sesiones?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Cerrar Todas las Demás Sesiones
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Actividad Reciente</h3>
                    
                    <div class="space-y-4">
                        @forelse($actividades as $actividad)
                            <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-8 h-8 bg-gray-100 text-gray-500 rounded-full flex items-center justify-center">
                                            @if($actividad->tipo == 'login')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                            @elseif($actividad->tipo == 'logout')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            @elseif($actividad->tipo == 'password_change')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">{{ $actividad->descripcion }}</p>
                                        <div class="flex items-center mt-1">
                                            <p class="text-xs text-gray-500">{{ $actividad->created_at->format('d/m/Y H:i') }}</p>
                                            <span class="mx-2 text-gray-300">•</span>
                                            <p class="text-xs text-gray-500">{{ $actividad->dispositivo }}</p>
                                            <span class="mx-2 text-gray-300">•</span>
                                            <p class="text-xs text-gray-500">{{ $actividad->ubicacion }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-gray-500">No hay actividad reciente para mostrar.</p>
                            </div>
                        @endforelse
                    </div>
                    
                    @if($actividades->count() > 0)
                        <div class="mt-4">
                            {{ $actividades->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection