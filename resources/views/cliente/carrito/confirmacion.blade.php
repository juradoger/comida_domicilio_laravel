@extends('Layouts.cliente')

@section('title', 'Pedido Confirmado')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-4xl text-green-600"></i>
                </div>

                <h2 class="text-3xl font-bold text-gray-800 mb-4">¡Pedido Confirmado!</h2>
                <p class="text-gray-600 mb-6">Tu pedido ha sido recibido y está siendo procesado.</p>

                <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Resumen del Pedido</h3>
                        <span class="text-sm text-gray-500">Pedido #{{ $pedido->id }}</span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fecha:</span>
                            <span class="font-medium">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Estado:</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $pedido->estado }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Método de pago:</span>
                            <span class="font-medium">{{ ucfirst($pedido->metodo_pago) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-bold text-orange-600">Bs. {{ number_format($pedido->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Detalles de la Entrega</h3>

                    <div class="space-y-4">
                        <div>
                            <span class="text-gray-600 block mb-1">Dirección de entrega:</span>
                            <span class="font-medium">{{ $pedido->direccion->direccion }}</span>
                            @if ($pedido->direccion->referencia)
                                <span class="text-sm text-gray-500 block mt-1">{{ $pedido->direccion->referencia }}</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-gray-600 block mb-1">Teléfono de contacto:</span>
                            <span class="font-medium">{{ $pedido->direccion->telefono }}</span>
                        </div>
                        @if ($pedido->instrucciones)
                            <div>
                                <span class="text-gray-600 block mb-1">Instrucciones especiales:</span>
                                <span class="font-medium">{{ $pedido->instrucciones }}</span>
                            </div>
                        @endif
                        <div>
                            <span class="text-gray-600 block mb-1">Tiempo estimado de entrega:</span>
                            <span class="font-medium">{{ $pedido->created_at->addMinutes(45)->format('H:i') }} -
                                {{ $pedido->created_at->addMinutes(60)->format('H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 text-left">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Productos</h3>

                    <div class="space-y-4">
                        @foreach ($pedido->detalles as $detalle)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-800">{{ $detalle->cantidad }}x</span>
                                    <span class="ml-2">{{ $detalle->producto->nombre }}</span>
                                </div>
                                <span class="font-medium">Bs.
                                    {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <p class="text-gray-600">Recibirás actualizaciones sobre el estado de tu pedido por correo electrónico y
                        en la sección "Mis Pedidos".</p>

                    <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('cliente.pedidos.show', $pedido->id) }}"
                            class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300 inline-block">
                            Ver Detalles del Pedido
                        </a>
                        <a href="{{ route('cliente.menu') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-md transition duration-300 inline-block">
                            Volver al Menú
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
