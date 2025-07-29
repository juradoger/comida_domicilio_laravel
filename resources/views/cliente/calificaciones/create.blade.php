@extends('Layouts.cliente')

@section('title', 'Calificar Pedido')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Calificar Pedido</h2>
            <a href="{{ route('pedidos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Pedidos
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
                                <p><span class="font-medium">Fecha de Entrega:</span>
                                    {{ $pedido->fecha_entrega ? date('d/m/Y H:i', strtotime($pedido->fecha_entrega)) : 'Pendiente' }}
                                </p>
                            </div>
                            <div>
                                <p><span class="font-medium">Estado:</span>
                                    {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}</p>
                                <p><span class="font-medium">Total:</span> Bs {{ number_format($pedido->total, 2) }}</p>
                                <p><span class="font-medium">Repartidor:</span>
                                    {{ $pedido->empleado->usuario->name ?? 'No asignado' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('cliente.calificaciones.store') }}" class="space-y-6">
                    @csrf

                    @if (isset($pedido))
                        <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
                        <input type="hidden" name="id_empleado" value="{{ $pedido->empleado_id }}">
                    @else
                        <div class="mb-4">
                            <label for="pedido_id" class="block text-gray-700 text-sm font-bold mb-2">Selecciona un
                                Pedido:</label>
                            <select name="id_pedido" id="pedido_id" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('id_pedido') border-red-500 @enderror">
                                <option value="">-- Selecciona un pedido --</option>
                                @if(isset($pedidos))
                                    @foreach ($pedidos as $pedido)
                                        <option value="{{ $pedido->id }}" data-empleado="{{ $pedido->empleado_id }}"
                                            {{ old('id_pedido') == $pedido->id ? 'selected' : '' }}>
                                            Pedido #{{ $pedido->id }} -
                                            {{ $pedido->empleado->usuario->name ?? 'Sin repartidor' }} -
                                            {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('id_pedido')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="id_empleado" id="empleado_id" value="{{ old('id_empleado') }}">
                    @endif

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Puntuación:</label>
                        <div class="flex items-center space-x-1">
                            <div class="flex items-center space-x-1" id="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button"
                                        class="star-btn text-gray-300 hover:text-yellow-400 focus:outline-none"
                                        data-rating="{{ $i }}">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="calificacion" id="puntuacion" value="{{ old('calificacion', 5) }}"
                                required>
                        </div>
                        @error('calificacion')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="comentario" class="block text-gray-700 text-sm font-bold mb-2">Comentario
                            (opcional):</label>
                        <textarea name="comentario" id="comentario" rows="4"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Cuéntanos tu experiencia con el servicio y el repartidor">{{ old('comentario') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300">
                            Enviar Calificación
                        </button>
                        <a href="{{ route('pedidos.index') }}"
                            class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejo de la selección de estrellas
            const starButtons = document.querySelectorAll('.star-btn');
            const puntuacionInput = document.getElementById('puntuacion');

            // Inicializar estrellas basado en el valor actual
            const initialRating = parseInt(puntuacionInput.value) || 0;
            updateStars(initialRating);

            // Agregar eventos a los botones de estrellas
            starButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    puntuacionInput.value = rating;
                    updateStars(rating);
                });
            });

            function updateStars(rating) {
                starButtons.forEach((btn, index) => {
                    if (index < rating) {
                        btn.classList.remove('text-gray-300');
                        btn.classList.add('text-yellow-400');
                    } else {
                        btn.classList.remove('text-yellow-400');
                        btn.classList.add('text-gray-300');
                    }
                });
            }

            // Si existe el selector de pedidos, actualizar el empleado_id cuando cambie
            const pedidoSelect = document.getElementById('pedido_id');
            const empleadoInput = document.getElementById('empleado_id');

            if (pedidoSelect && empleadoInput) {
                pedidoSelect.addEventListener('change', function() {
                    const selectedOption = pedidoSelect.options[pedidoSelect.selectedIndex];
                    if (selectedOption.value) {
                        empleadoInput.value = selectedOption.dataset.empleado;
                    } else {
                        empleadoInput.value = '';
                    }
                });

                // Inicializar el empleado_id si hay un pedido seleccionado
                if (pedidoSelect.value) {
                    const selectedOption = pedidoSelect.options[pedidoSelect.selectedIndex];
                    empleadoInput.value = selectedOption.dataset.empleado;
                }
            }
        });
    </script>
@endsection
