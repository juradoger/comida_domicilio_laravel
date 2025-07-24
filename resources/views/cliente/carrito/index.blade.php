@extends('Layouts.cliente')

@section('title', 'Mi Carrito')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Mi Carrito</h2>
            <a href="{{ route('cliente.menu') }}" class="text-orange-600 hover:text-orange-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Continuar comprando
            </a>
        </div>

        @if (count($items) > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16">
                                                @if ($item->producto->imagen)
                                                    <img class="h-16 w-16 object-cover rounded"
                                                        src="{{ asset('storage/' . $item->producto->imagen) }}"
                                                        alt="{{ $item->producto->nombre }}">
                                                @else
                                                    <div
                                                        class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                        <i class="fas fa-utensils text-gray-400 text-2xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->producto->nombre }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $item->producto->categoria->nombre }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        S/. {{ number_format($item->producto->precio, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            <form action="{{ route('cliente.carrito.update', $item->id) }}" method="POST"
                                                class="flex items-center">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="action" value="decrease"
                                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold w-8 h-8 rounded-l flex items-center justify-center transition duration-300">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" name="cantidad" value="{{ $item->cantidad }}"
                                                    min="1" max="20"
                                                    class="w-12 h-8 text-center border-gray-200 focus:border-orange-500 focus:ring focus:ring-orange-200"
                                                    readonly>
                                                <button type="submit" name="action" value="increase"
                                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold w-8 h-8 rounded-r flex items-center justify-center transition duration-300">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                        S/. {{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <form action="{{ route('cliente.carrito.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('¿Estás seguro de eliminar este producto del carrito?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-8">
                <!-- Resumen del pedido -->
                <div class="md:w-1/2 lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Resumen del Pedido</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">S/. {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Costo de envío:</span>
                                <span class="font-medium">S/. {{ number_format($costoEnvio, 2) }}</span>
                            </div>
                            @if ($descuento > 0)
                                <div class="flex justify-between text-green-600">
                                    <span>Descuento:</span>
                                    <span class="font-medium">- S/. {{ number_format($descuento, 2) }}</span>
                                </div>
                            @endif
                            <div class="pt-4 border-t">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total:</span>
                                    <span class="text-xl font-bold text-orange-600">S/.
                                        {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cupón de descuento -->
                    <div class="mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Cupón de Descuento</h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('cliente.carrito.aplicar-cupon') }}" method="POST" class="flex">
                                @csrf
                                <input type="text" name="codigo" placeholder="Ingresa tu código"
                                    class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                <button type="submit"
                                    class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-r-md transition duration-300">
                                    Aplicar
                                </button>
                            </form>
                            @if (session('cupon_error'))
                                <p class="text-red-500 text-sm mt-2">{{ session('cupon_error') }}</p>
                            @endif
                            @if (session('cupon_success'))
                                <p class="text-green-500 text-sm mt-2">{{ session('cupon_success') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información de entrega -->
                <div class="md:w-1/2 lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Información de Entrega</h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('cliente.carrito.checkout') }}" method="POST">
                                @csrf

                                <div class="mb-6">
                                    <h4 class="text-md font-bold text-gray-700 mb-3">Información de Entrega</h4>

                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                                        <p class="text-blue-700 mb-2">La información de entrega se configurará en el
                                            siguiente paso.</p>
                                        <p class="text-sm text-blue-600">Procede con el pedido para continuar.</p>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <h4 class="text-md font-bold text-gray-700 mb-3">Método de pago</h4>

                                    <div class="space-y-3">
                                        <div class="border rounded-lg p-4 border-gray-200">
                                            <div class="flex items-start">
                                                <input type="radio" name="metodo_pago" id="metodo_efectivo"
                                                    value="efectivo"
                                                    class="mt-1 rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                                                    checked>
                                                <label for="metodo_efectivo" class="ml-3 flex-1">
                                                    <div class="font-medium text-gray-800">Efectivo</div>
                                                    <div class="text-sm text-gray-600 mt-1">Paga en efectivo al momento de
                                                        la entrega</div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="border rounded-lg p-4 border-gray-200">
                                            <div class="flex items-start">
                                                <input type="radio" name="metodo_pago" id="metodo_tarjeta"
                                                    value="tarjeta"
                                                    class="mt-1 rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                                <label for="metodo_tarjeta" class="ml-3 flex-1">
                                                    <div class="font-medium text-gray-800">Tarjeta de crédito/débito</div>
                                                    <div class="text-sm text-gray-600 mt-1">Paga con tarjeta al momento de
                                                        la entrega</div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="border rounded-lg p-4 border-gray-200">
                                            <div class="flex items-start">
                                                <input type="radio" name="metodo_pago" id="metodo_yape" value="yape"
                                                    class="mt-1 rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                                <label for="metodo_yape" class="ml-3 flex-1">
                                                    <div class="font-medium text-gray-800">Yape</div>
                                                    <div class="text-sm text-gray-600 mt-1">Paga con Yape al momento de la
                                                        entrega</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="instrucciones"
                                        class="block text-md font-bold text-gray-700 mb-2">Instrucciones especiales
                                        (opcional)</label>
                                    <textarea name="instrucciones" id="instrucciones" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200"
                                        placeholder="Instrucciones para la entrega o preparación"></textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-3 px-8 rounded-md transition duration-300">
                                        Continuar con el Pedido
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-shopping-cart text-6xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tu carrito está vacío</h3>
                <p class="text-gray-600 mb-6">Parece que aún no has agregado productos a tu carrito.</p>
                <a href="{{ route('cliente.menu') }}"
                    class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300 inline-block">
                    Ver Menú
                </a>
            </div>
        @endif
    </div>
@endsection
