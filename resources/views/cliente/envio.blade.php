@extends('Layouts.cliente')

@section('title', 'Solicitar Envío')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Solicitar Envío</h2>
        
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            <form method="POST" action="{{ route('cliente.solicitar_envio') }}" class="space-y-6">
                @csrf
                
                <div class="mb-4">
                    <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección de entrega:</label>
                    <input type="text" name="direccion" id="direccion" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('direccion') border-red-500 @enderror" 
                           value="{{ old('direccion') }}" placeholder="Ingresa tu dirección completa">
                    @error('direccion')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="referencia" class="block text-gray-700 text-sm font-bold mb-2">Referencia (opcional):</label>
                    <input type="text" name="referencia" id="referencia" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           value="{{ old('referencia') }}" placeholder="Alguna referencia para ubicar tu dirección">
                </div>
                
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono de contacto:</label>
                    <input type="text" name="telefono" id="telefono" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telefono') border-red-500 @enderror" 
                           value="{{ old('telefono') }}" placeholder="Ingresa tu número de teléfono">
                    @error('telefono')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="fecha_entrega" class="block text-gray-700 text-sm font-bold mb-2">Fecha y hora de entrega deseada:</label>
                    <input type="datetime-local" name="fecha_entrega" id="fecha_entrega" required 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('fecha_entrega') border-red-500 @enderror" 
                           value="{{ old('fecha_entrega') }}">
                    @error('fecha_entrega')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="instrucciones" class="block text-gray-700 text-sm font-bold mb-2">Instrucciones especiales (opcional):</label>
                    <textarea name="instrucciones" id="instrucciones" rows="3" 
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                              placeholder="Instrucciones adicionales para la entrega">{{ old('instrucciones') }}</textarea>
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Solicitar Envío
                    </button>
                    <a href="{{ route('cliente.menu') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                        Volver al menú
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection