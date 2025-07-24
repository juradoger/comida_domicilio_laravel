@extends('Layouts.cliente')

@section('title', 'Confirmar Pedido')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Confirmar Pedido</h1>

            <form action="{{ route('cliente.pedidos.store') }}" method="POST" id="form-pedido">
                @csrf

                <!-- Productos del carrito -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Productos en tu pedido</h2>

                    @php
                        $carrito = session('carrito', []);
                        $subtotal = 0;
                    @endphp

                    @if (!empty($carrito))
                        <div class="space-y-4 mb-6">
                            @foreach ($carrito as $item)
                                @php $subtotal += $item['precio'] * $item['cantidad']; @endphp
                                <div class="flex items-center space-x-4 p-4 border rounded-lg bg-gray-50">
                                    <div class="flex-shrink-0">
                                        @if ($item['imagen'])
                                            <img src="{{ asset('storage/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}"
                                                class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-medium text-gray-800">{{ $item['nombre'] }}</h3>
                                        <p class="text-gray-600">Cantidad: {{ $item['cantidad'] }}</p>
                                        <p class="text-gray-600">${{ number_format($item['precio'], 2) }} c/u</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">
                                            ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                        </p>
                                    </div>

                                    <!-- Campos ocultos para enviar los productos -->
                                    <input type="hidden" name="productos[{{ $loop->index }}][id]"
                                        value="{{ $item['id'] }}">
                                    <input type="hidden" name="productos[{{ $loop->index }}][cantidad]"
                                        value="{{ $item['cantidad'] }}">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">No hay productos en tu carrito</p>
                            <a href="{{ route('cliente.menu') }}"
                                class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                                Ver Menú
                            </a>
                        </div>
                    @endif
                </div>

                @if (!empty($carrito))
                    <!-- Método de entrega -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Método de entrega</h2>
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="domicilio">
                                <input type="radio" id="domicilio" name="metodo_entrega" value="domicilio" class="mr-3"
                                    checked>
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-orange-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <span class="font-medium">Entrega a domicilio</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Recibirás tu pedido en la dirección que
                                        especifiques</p>
                                </div>
                                <span class="text-green-600 font-medium">$10.00</span>
                            </label>

                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="recoger">
                                <input type="radio" id="recoger" name="metodo_entrega" value="recoger" class="mr-3">
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-orange-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="font-medium">Recoger en tienda</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Recoge tu pedido en nuestro local</p>
                                </div>
                                <span class="text-green-600 font-medium">Gratis</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dirección de entrega (solo para domicilio) -->
                    <div id="direccion-container" class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Dirección de entrega</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">Dirección
                                    completa *</label>
                                <textarea id="direccion" name="direccion" rows="3"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Ej: Av. Principal 123, Colonia Centro, Referencias: Casa azul con portón negro" required></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="latitud" class="block text-sm font-medium text-gray-700 mb-2">Latitud
                                        (opcional)</label>
                                    <input type="number" id="latitud" name="latitud" step="any"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Ej: 19.432608">
                                </div>
                                <div>
                                    <label for="longitud" class="block text-sm font-medium text-gray-700 mb-2">Longitud
                                        (opcional)</label>
                                    <input type="number" id="longitud" name="longitud" step="any"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Ej: -99.133209">
                                </div>
                            </div>

                            <button type="button" onclick="obtenerUbicacion()"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Usar mi ubicación actual
                            </button>
                        </div>
                    </div>

                    <!-- Método de pago -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Método de pago</h2>
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="efectivo">
                                <input type="radio" id="efectivo" name="metodo_pago" value="efectivo" class="mr-3"
                                    checked>
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-green-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 0h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V9z" />
                                        </svg>
                                        <span class="font-medium">Efectivo</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Pago en efectivo al momento de la entrega</p>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="tarjeta">
                                <input type="radio" id="tarjeta" name="metodo_pago" value="tarjeta" class="mr-3">
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-blue-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <span class="font-medium">Tarjeta de crédito/débito</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Pago con tarjeta al momento de la entrega</p>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="yape">
                                <input type="radio" id="yape" name="metodo_pago" value="yape" class="mr-3">
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-purple-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium">Yape</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Pago mediante Yape</p>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50"
                                for="transferencia">
                                <input type="radio" id="transferencia" name="metodo_pago" value="transferencia"
                                    class="mr-3">
                                <div class="flex-grow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        <span class="font-medium">Transferencia bancaria</span>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-9">Pago mediante transferencia bancaria</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Resumen del pedido -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Resumen del pedido</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Costo de envío:</span>
                                <span class="font-medium" id="costo-envio">$10.00</span>
                            </div>
                            <div class="border-t pt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-800">Total:</span>
                                    <span class="text-lg font-bold text-orange-600"
                                        id="total-pedido">${{ number_format($subtotal + 10, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('cliente.carrito') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                            ← Volver al carrito
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-medium">
                            Confirmar pedido
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const radioButtons = document.querySelectorAll('input[name="metodo_entrega"]');
                const direccionContainer = document.getElementById('direccion-container');
                const costoEnvio = document.getElementById('costo-envio');
                const totalPedido = document.getElementById('total-pedido');
                const direccionInput = document.getElementById('direccion');
                const subtotal = {{ $subtotal }};

                function actualizarTotal() {
                    const metodoEntrega = document.querySelector('input[name="metodo_entrega"]:checked').value;
                    let envio = metodoEntrega === 'domicilio' ? 10 : 0;
                    let total = subtotal + envio;

                    costoEnvio.textContent = envio === 0 ? 'Gratis' : '$' + envio.toFixed(2);
                    totalPedido.textContent = '$' + total.toFixed(2);
                }

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'domicilio') {
                            direccionContainer.style.display = 'block';
                            direccionInput.setAttribute('required', 'required');
                        } else {
                            direccionContainer.style.display = 'none';
                            direccionInput.removeAttribute('required');
                            direccionInput.value = ''; // Limpiar el campo
                        }
                        actualizarTotal();
                    });
                });

                // Inicializar la vista al cargar la página
                const metodoInicial = document.querySelector('input[name="metodo_entrega"]:checked').value;
                if (metodoInicial === 'recoger') {
                    direccionContainer.style.display = 'none';
                    direccionInput.removeAttribute('required');
                }
                actualizarTotal();
            });

            function obtenerUbicacion() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        document.getElementById('latitud').value = position.coords.latitude;
                        document.getElementById('longitud').value = position.coords.longitude;
                        alert('Ubicación obtenida correctamente');
                    }, function() {
                        alert('No se pudo obtener la ubicación');
                    });
                } else {
                    alert('Tu navegador no soporta geolocalización');
                }
            }
        </script>
    @endpush
@endsection
