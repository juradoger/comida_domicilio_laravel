@extends('Layouts.cliente')

@section('title', 'Mis Pagos')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Mis Pagos</h2>

        @if (count($pagos) > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-orange-500 to-red-600">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Pedido
                            </th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Monto
                            </th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Método
                            </th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Estado
                            </th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha
                            </th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pagos as $pago)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-4 whitespace-nowrap">{{ $pago->id }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <a href="{{ route('cliente.pedidos.show', $pago->id_pedido) }}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        Pedido #{{ $pago->id_pedido }}
                                    </a>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">Bs
                                    {{ number_format($pago->monto, 2) }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ ucfirst($pago->metodo_pago) }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($pago->estado == 'completado') bg-green-100 text-green-800
                                        @elseif($pago->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                        @elseif($pago->estado == 'rechazado') bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($pago->estado) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $pago->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('cliente.pagos.show', $pago->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[var(--color-primario)] to-[var(--color-secundario)] text-white font-semibold rounded-lg shadow hover:from-[var(--color-secundario)] hover:to-[var(--color-primario)] transition-colors duration-200">
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pagos->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4">No tienes pagos registrados.</p>
                <a href="{{ route('cliente.pedidos.index') }}"
                    class="inline-block bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold py-2 px-4 rounded hover:from-orange-600 hover:to-red-700 transition duration-300">
                    Ver mis pedidos
                </a>
            </div>
        @endif
    </div>
@endsection
