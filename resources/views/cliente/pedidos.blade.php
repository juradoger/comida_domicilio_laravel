@extends('Layouts.cliente')

@section('title', 'Mis Pedidos')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Mis Pedidos</h2>
        
        @if(count($pedidos) > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-orange-500 to-red-600">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Productos</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Total</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha Pedido</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha Entrega</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pedidos as $pedido)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-4 whitespace-nowrap">{{ $pedido->id }}</td>
                                <td class="py-4 px-4">
                                    <div class="text-sm text-gray-900">
                                        @foreach($pedido->detalles as $detalle)
                                            <div class="mb-1">
                                                {{ $detalle->producto->nombre }} ({{ $detalle->cantidad }})
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">S/ {{ number_format($pedido->total, 2) }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($pedido->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                        @elseif($pedido->estado == 'en_proceso') bg-blue-100 text-blue-800
                                        @elseif($pedido->estado == 'en_camino') bg-indigo-100 text-indigo-800
                                        @elseif($pedido->estado == 'entregado') bg-green-100 text-green-800
                                        @elseif($pedido->estado == 'cancelado') bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">{{ $pedido->fecha_entrega ? date('d/m/Y H:i', strtotime($pedido->fecha_entrega)) : 'Pendiente' }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('cliente.pedidos.show', $pedido->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver detalles</a>
                                        
                                        @if($pedido->estado == 'entregado' && !$pedido->calificacion)
                                            <a href="{{ route('cliente.calificaciones.create', ['pedido_id' => $pedido->id]) }}" class="text-yellow-600 hover:text-yellow-900">Calificar</a>
                                        @endif
                                        
                                        @if($pedido->estado == 'pendiente')
                                            <form action="{{ route('cliente.pedidos.cancelar', $pedido->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de cancelar este pedido?')">Cancelar</button>
                                            </form>
                                        @endif
                                        
                                        @if(!$pedido->pago && ($pedido->estado == 'pendiente' || $pedido->estado == 'en_proceso'))
                                            <a href="{{ route('cliente.pagos.create', ['pedido_id' => $pedido->id]) }}" class="text-green-600 hover:text-green-900">Pagar</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $pedidos->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4">No tienes pedidos registrados.</p>
                <a href="{{ route('cliente.menu') }}" class="inline-block bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold py-2 px-4 rounded hover:from-orange-600 hover:to-red-700 transition duration-300">
                    Ver menú de productos
                </a>
            </div>
        @endif
    </div>
@endsection