@extends('Layouts.cliente')

@section('title', 'Mi Carrito')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Mi Carrito</h2>
            <div class="flex items-center space-x-4">
                <form action="{{ route('cliente.carrito.vaciar') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300"
                        onclick="return confirm('¿Estás seguro de vaciar todo el carrito?')">
                        <i class="fas fa-trash mr-2"></i>
                        Vaciar Carrito
                    </button>
                </form>
                <a href="{{ route('cliente.menu') }}" class="text-orange-600 hover:text-orange-800 font-medium">
                    <i class="text-orange-600 fas fa-arrow-left mr-2"></i> Continuar comprando
                </a>
            </div>
        </div>

        @if (count($items) > 0)
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
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
                                        <span class="text-xs align-top">Bs</span> {{ number_format($item->producto->precio, 2, '.', ',') }}
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
                                        <span class="text-xs align-top">Bs</span> {{ number_format($item->producto->precio * $item->cantidad, 2, '.', ',') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <form action="{{ route('cliente.carrito.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 flex items-center justify-center mx-auto"
                                                onclick="return confirm('¿Estás seguro de quitar este producto del carrito?')">
                                                <i class="fas fa-trash mr-1"></i>
                                                Quitar
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
                                <span class="font-medium"><span class="text-xs align-top">Bs</span> {{ number_format($subtotal, 2, '.', ',') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Costo de envío:</span>
                                <span class="font-medium"><span class="text-xs align-top">Bs</span> {{ number_format($costoEnvio, 2, '.', ',') }}</span>
                            </div>
                            @if ($descuento > 0)
                                <div class="flex justify-between text-green-600">
                                    <span>
                                        <i class="fas fa-tag mr-1"></i>
                                        Descuento (10% usuarios nuevos):
                                    </span>
                                    <span class="font-medium">-<span class="text-xs align-top">Bs</span> {{ number_format($descuento, 2, '.', ',') }}</span>
                                </div>
                                @php
                                    $diasRestantes = round(30 - Auth::user()->created_at->diffInDays(now()));
                                @endphp
                                <div class="text-center mt-2">
                                    <span class="text-xs text-green-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        Te quedan {{ $diasRestantes }} días para aprovechar este descuento
                                    </span>
                                </div>
                            @elseif(Auth::check() && !$usuarioReciente)
                                <div class="text-center mt-2">
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        El descuento de usuarios nuevos expiró hace {{ round(Auth::user()->created_at->diffInDays(now()) - 30) }} días
                                    </span>
                                </div>
                            @endif
                            <div class="pt-4 border-t">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total:</span>
                                    <span class="text-xl font-bold text-orange-600"><span class="text-xs align-top">Bs</span> {{ number_format($total, 2, '.', ',') }}</span>
                                </div>
                                @if ($descuento > 0)
                                    <div class="mt-2 text-center">
                                        <span class="text-sm text-green-600 font-medium">
                                            <i class="fas fa-piggy-bank mr-1"></i>
                                            ¡Ahorras Bs {{ number_format($descuento, 2, '.', ',') }}!
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Información de descuentos -->
                    <div class="mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b">
                            <h3 class="text-lg font-bold text-gray-800">Descuentos Disponibles</h3>
                        </div>
                        <div class="p-6">
                            @if(Auth::check())
                                @if($usuarioReciente)
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                            <div>
                                                <h4 class="font-medium text-green-800">¡Descuento aplicado!</h4>
                                                <p class="text-sm text-green-600">Como usuario nuevo (registrado en los últimos 30 días), tienes un 10% de descuento en tu pedido.</p>
                                                <p class="text-xs text-green-500 mt-1">Fecha de registro: {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-info-circle text-gray-600 mr-3"></i>
                                            <div>
                                                <h4 class="font-medium text-gray-800">Descuento no disponible</h4>
                                                <p class="text-sm text-gray-600">El descuento del 10% está disponible solo para usuarios registrados en los últimos 30 días.</p>
                                                <p class="text-xs text-gray-500 mt-1">Te registraste el: {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                                        <div>
                                            <h4 class="font-medium text-blue-800">¡Regístrate y ahorra!</h4>
                                            <p class="text-sm text-blue-600">Los usuarios nuevos (registrados en los últimos 30 días) obtienen un 10% de descuento automático.</p>
                                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm mt-2 inline-block">
                                                <i class="fas fa-user-plus mr-1"></i>
                                                Registrarse ahora
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                                        <p class="text-blue-700 mb-2">La información de entrega y método de pago se configurarán en el siguiente paso.</p>
                                        <p class="text-sm text-blue-600">Procede con el pedido para continuar.</p>
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
                <p class="text-gray-600 mb-6">Parece que aún no has agregado productos a tu carrito o los has eliminado todos.</p>
                <div class="space-y-3">
                    <a href="{{ route('cliente.menu') }}"
                        class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300 inline-block">
                        <i class="fas fa-utensils mr-2"></i>
                        Ver Menú
                    </a>
                    <br>
                    <a href="{{ route('cliente.pedidos.index') }}"
                        class="text-orange-600 hover:text-orange-800 font-medium">
                        <i class="fas fa-list mr-2"></i>
                        Ver mis pedidos
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
