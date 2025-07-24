@extends('Layouts.cliente')

@section('title', 'Mi Perfil')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Mi Perfil</h2>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Sidebar con foto y estadísticas -->
                <div class="md:w-1/3 bg-gradient-to-b from-orange-500 to-red-600 text-white p-6">
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full bg-white p-1 mb-4">
                            @if($cliente->foto)
                                <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto de perfil" class="w-full h-full object-cover rounded-full">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded-full">
                                    <span class="text-4xl font-bold text-gray-500">{{ substr($cliente->nombre, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-1">{{ $cliente->nombre }} {{ $cliente->apellido }}</h3>
                        <p class="text-sm opacity-80 mb-4">Cliente desde {{ $cliente->created_at->format('d/m/Y') }}</p>
                        
                        <div class="w-full mt-6 space-y-4">
                            <div class="bg-white bg-opacity-20 rounded-lg p-4">
                                <h4 class="font-bold mb-1">Pedidos Realizados</h4>
                                <p class="text-2xl font-bold">{{ $estadisticas['total_pedidos'] }}</p>
                            </div>
                            
                            <div class="bg-white bg-opacity-20 rounded-lg p-4">
                                <h4 class="font-bold mb-1">Calificaciones Enviadas</h4>
                                <p class="text-2xl font-bold">{{ $estadisticas['total_calificaciones'] }}</p>
                            </div>
                            
                            <div class="bg-white bg-opacity-20 rounded-lg p-4">
                                <h4 class="font-bold mb-1">Último Pedido</h4>
                                <p class="text-sm">{{ $estadisticas['ultimo_pedido'] ? $estadisticas['ultimo_pedido']->format('d/m/Y') : 'Sin pedidos' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Formulario de datos personales -->
                <div class="md:w-2/3 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Información Personal</h3>
                    
                    <form action="{{ route('cliente.perfil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('nombre')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $cliente->apellido) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('apellido')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('telefono')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('direccion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto de Perfil</label>
                                <input type="file" name="foto" id="foto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                @error('foto')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Cambiar Contraseña</h3>
                            <p class="text-sm text-gray-600 mb-4">Deja estos campos en blanco si no deseas cambiar tu contraseña.</p>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña Actual</label>
                                    <input type="password" name="current_password" id="current_password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    @error('current_password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div></div>
                                
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                                    <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Nueva Contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection