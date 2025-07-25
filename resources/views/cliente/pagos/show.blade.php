@extends('Layouts.cliente')

@section('title', 'Detalles del Pago')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Detalles del Pago #{{ $pago->id }}</h2>
            <a href="{{ route('cliente.pagos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Pagos
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Información del Pago</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">ID:</span>
                                <span class="text-gray-800">{{ $pago->id }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Monto:</span>
                                <span class="text-gray-800 font-bold">Bs {{ number_format($pago->monto, 2) }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Método de Pago:</span>
                                <span class="text-gray-800">{{ ucfirst($pago->metodo_pago) }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Estado:</span>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($pago->estado_pago == 'pagado') bg-green-100 text-green-800
                                    @elseif($pago->estado_pago == 'pendiente') bg-yellow-100 text-yellow-800
                                    @elseif($pago->estado_pago == 'fallido') bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($pago->estado_pago) }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Fecha de Pago:</span>
                                <span class="text-gray-800">{{ $pago->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            @if ($pago->referencia)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Referencia:</span>
                                    <span class="text-gray-800">{{ $pago->referencia }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Información del Pedido</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Pedido ID:</span>
                                <a href="{{ route('cliente.pedidos.show', $pago->id_pedido) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    #{{ $pago->id_pedido }}
                                </a>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Estado del Pedido:</span>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($pago->pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                    @elseif($pago->pedido->estado == 'en_proceso') bg-blue-100 text-blue-800
                                    @elseif($pago->pedido->estado == 'en_camino') bg-indigo-100 text-indigo-800
                                    @elseif($pago->pedido->estado == 'entregado') bg-green-100 text-green-800
                                    @elseif($pago->pedido->estado == 'cancelado') bg-red-100 text-red-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $pago->pedido->estado)) }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Fecha del Pedido:</span>
                                <span class="text-gray-800">{{ $pago->pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Total del Pedido:</span>
                                <span class="text-gray-800 font-bold">Bs
                                    {{ number_format($pago->pedido->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($pago->comentarios)
                    <div class="mt-6">
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Comentarios:</h3>
                        <p class="text-gray-600 bg-gray-50 p-3 rounded">{{ $pago->comentarios }}</p>
                    </div>
                @endif

                @if ($pago->estado_pago == 'pendiente')
                    <div class="mt-6 border-t pt-4">
                        <div class="flex justify-end">
                            <form action="{{ route('cliente.pagos.cancelar', $pago->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300"
                                    onclick="return confirm('¿Estás seguro de cancelar este pago?')">
                                    Cancelar Pago
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
