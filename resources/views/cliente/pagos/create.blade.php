@extends('Layouts.cliente')

@section('title', 'Realizar Pago')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Realizar Pago</h2>
            <a href="{{ route('cliente.pagos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Pagos
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                @if (isset($pedido))
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Información del Pedido</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p><span class="font-medium">Pedido ID:</span> #{{ $pedido->id }}</p>
                                <p><span class="font-medium">Fecha:</span> {{ $pedido->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div>
                                <p><span class="font-medium">Estado:</span>
                                    {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}</p>
                                <p><span class="font-medium">Total a pagar:</span> <span class="font-bold">Bs
                                        {{ number_format($pedido->total, 2) }}</span></p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('cliente.pagos.store') }}" class="space-y-6">
                    @csrf

                    @if (isset($pedido))
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <input type="hidden" name="monto" value="{{ $pedido->total }}">
                    @else
                        <div class="mb-4">
                            <label for="pedido_id" class="block text-gray-700 text-sm font-bold mb-2">Selecciona un
                                Pedido:</label>
                            <select name="pedido_id" id="pedido_id" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pedido_id') border-red-500 @enderror">
                                <option value="">-- Selecciona un pedido --</option>
                                @foreach ($pedidos as $pedido)
                                    <option value="{{ $pedido->id }}" data-monto="{{ $pedido->total }}"
                                        {{ old('pedido_id') == $pedido->id ? 'selected' : '' }}>
                                        Pedido #{{ $pedido->id }} - Bs {{ number_format($pedido->total, 2) }} -
                                        {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pedido_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="monto" class="block text-gray-700 text-sm font-bold mb-2">Monto a Pagar:</label>
                            <input type="number" name="monto" id="monto" step="0.01" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('monto') border-red-500 @enderror"
                                value="{{ old('monto') }}" readonly>
                            @error('monto')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="metodo_pago" class="block text-gray-700 text-sm font-bold mb-2">Método de Pago:</label>
                        <select name="metodo_pago" id="metodo_pago" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('metodo_pago') border-red-500 @enderror">
                            <option value="">-- Selecciona un método de pago --</option>
                            <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo
                            </option>
                            <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta de
                                Crédito/Débito</option>
                            <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>
                                Transferencia Bancaria</option>
                            <option value="yape" {{ old('metodo_pago') == 'yape' ? 'selected' : '' }}>Yape</option>
                            <option value="plin" {{ old('metodo_pago') == 'plin' ? 'selected' : '' }}>Plin</option>
                        </select>
                        @error('metodo_pago')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="referencia" class="block text-gray-700 text-sm font-bold mb-2">Referencia de Pago
                            (opcional):</label>
                        <input type="text" name="referencia" id="referencia"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('referencia') }}"
                            placeholder="Número de operación, últimos dígitos de tarjeta, etc.">
                    </div>

                    <div class="mb-4">
                        <label for="comentarios" class="block text-gray-700 text-sm font-bold mb-2">Comentarios
                            (opcional):</label>
                        <textarea name="comentarios" id="comentarios" rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Información adicional sobre el pago">{{ old('comentarios') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300">
                            Realizar Pago
                        </button>
                        <a href="{{ route('cliente.pedidos') }}"
                            class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (!isset($pedido))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pedidoSelect = document.getElementById('pedido_id');
                const montoInput = document.getElementById('monto');

                // Actualizar el monto cuando se selecciona un pedido
                pedidoSelect.addEventListener('change', function() {
                    const selectedOption = pedidoSelect.options[pedidoSelect.selectedIndex];
                    if (selectedOption.value) {
                        montoInput.value = selectedOption.dataset.monto;
                    } else {
                        montoInput.value = '';
                    }
                });

                // Inicializar el monto si hay un pedido seleccionado
                if (pedidoSelect.value) {
                    const selectedOption = pedidoSelect.options[pedidoSelect.selectedIndex];
                    montoInput.value = selectedOption.dataset.monto;
                }
            });
        </script>
    @endif
@endsection
