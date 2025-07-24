@extends('Layouts.cliente')

@section('title', 'Calificar Pedido')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Calificar Pedido #{{ $pedido->id }}</h1>
            
            <!-- Resumen del Pedido -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Resumen del Pedido</h2>
                            <p class="text-gray-600">Fecha: {{ $pedido->fecha_pedido }}</p>
                            <p class="text-gray-600">Restaurante: {{ $pedido->restaurante->nombre }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                @if($pedido->estado == 'Entregado') bg-green-100 text-green-800 @endif
                                @if($pedido->estado == 'En proceso') bg-blue-100 text-blue-800 @endif
                                @if($pedido->estado == 'Pendiente') bg-yellow-100 text-yellow-800 @endif
                                @if($pedido->estado == 'Cancelado') bg-red-100 text-red-800 @endif
                            ">
                                {{ $pedido->estado }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Productos del Pedido -->
                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Productos</h3>
                        <div class="space-y-4">
                            @foreach($pedido->detalles as $detalle)
                                <div class="flex items-center">
                                    <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}" class="w-16 h-16 object-cover rounded-md mr-4" onerror="this.src='https://via.placeholder.com/64?text=Producto'">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">{{ $detalle->producto->nombre }}</h4>
                                        <p class="text-sm text-gray-600">Cantidad: {{ $detalle->cantidad }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">S/. {{ number_format($detalle->precio_unitario, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de Calificación -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tu Opinión es Importante</h2>
                    
                    <form action="{{ route('cliente.pedidos.guardar-calificacion', $pedido->id) }}" method="POST">
                        @csrf
                        
                        <!-- Calificación General -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Calificación General</h3>
                            <div class="flex items-center">
                                <div class="rating-stars flex space-x-1" id="rating-general">
                                    <input type="hidden" name="calificacion_general" id="calificacion-general-input" value="5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" class="star-btn text-2xl" data-rating="{{ $i }}" data-target="general">
                                            <i class="fas fa-star text-yellow-400"></i>
                                        </button>
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-600" id="rating-general-text">Excelente</span>
                            </div>
                        </div>
                        
                        <!-- Calificaciones Específicas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Calidad de la Comida -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Calidad de la Comida</h3>
                                <div class="flex items-center">
                                    <div class="rating-stars flex space-x-1" id="rating-comida">
                                        <input type="hidden" name="calificacion_comida" id="calificacion-comida-input" value="5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="star-btn text-xl" data-rating="{{ $i }}" data-target="comida">
                                                <i class="fas fa-star text-yellow-400"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tiempo de Entrega -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Tiempo de Entrega</h3>
                                <div class="flex items-center">
                                    <div class="rating-stars flex space-x-1" id="rating-tiempo">
                                        <input type="hidden" name="calificacion_tiempo" id="calificacion-tiempo-input" value="5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="star-btn text-xl" data-rating="{{ $i }}" data-target="tiempo">
                                                <i class="fas fa-star text-yellow-400"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Servicio del Repartidor -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Servicio del Repartidor</h3>
                                <div class="flex items-center">
                                    <div class="rating-stars flex space-x-1" id="rating-repartidor">
                                        <input type="hidden" name="calificacion_repartidor" id="calificacion-repartidor-input" value="5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="star-btn text-xl" data-rating="{{ $i }}" data-target="repartidor">
                                                <i class="fas fa-star text-yellow-400"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Relación Calidad-Precio -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Relación Calidad-Precio</h3>
                                <div class="flex items-center">
                                    <div class="rating-stars flex space-x-1" id="rating-precio">
                                        <input type="hidden" name="calificacion_precio" id="calificacion-precio-input" value="5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="star-btn text-xl" data-rating="{{ $i }}" data-target="precio">
                                                <i class="fas fa-star text-yellow-400"></i>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comentario -->
                        <div class="mb-8">
                            <label for="comentario" class="block text-lg font-semibold text-gray-800 mb-3">Tu Comentario</label>
                            <textarea id="comentario" name="comentario" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" placeholder="Comparte tu experiencia con este pedido..."></textarea>
                        </div>
                        
                        <!-- Productos Destacados -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">¿Qué productos te gustaron más?</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($pedido->detalles as $detalle)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="producto-{{ $detalle->id }}" name="productos_destacados[]" value="{{ $detalle->producto_id }}" class="rounded border-gray-300 text-orange-500 focus:border-orange-500 focus:ring focus:ring-orange-200">
                                        <label for="producto-{{ $detalle->id }}" class="ml-2 text-gray-700">{{ $detalle->producto->nombre }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Fotos (opcional) -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Añadir Fotos (opcional)</h3>
                            <div class="flex items-center justify-center w-full">
                                <label for="fotos" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir</span> o arrastra y suelta</p>
                                        <p class="text-xs text-gray-500">PNG, JPG o JPEG (máx. 5MB)</p>
                                    </div>
                                    <input id="fotos" name="fotos[]" type="file" class="hidden" multiple accept="image/*">
                                </label>
                            </div>
                            <div id="preview-container" class="mt-4 flex flex-wrap gap-2"></div>
                        </div>
                        
                        <!-- Botones de Acción -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('cliente.pedidos.show', $pedido->id) }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">Cancelar</a>
                            <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-200">Enviar Calificación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejo de calificaciones por estrellas
            const ratingTexts = {
                1: 'Muy malo',
                2: 'Malo',
                3: 'Regular',
                4: 'Bueno',
                5: 'Excelente'
            };
            
            // Función para actualizar estrellas
            function updateStars(target, rating) {
                const stars = document.querySelectorAll(`#rating-${target} .star-btn`);
                const input = document.getElementById(`calificacion-${target}-input`);
                
                // Actualizar valor del input
                input.value = rating;
                
                // Actualizar estrellas
                stars.forEach((star, index) => {
                    const starRating = parseInt(star.getAttribute('data-rating'));
                    const starIcon = star.querySelector('i');
                    
                    if (starRating <= rating) {
                        starIcon.classList.add('text-yellow-400');
                        starIcon.classList.remove('text-gray-300');
                    } else {
                        starIcon.classList.remove('text-yellow-400');
                        starIcon.classList.add('text-gray-300');
                    }
                });
                
                // Actualizar texto para calificación general
                if (target === 'general') {
                    const ratingText = document.getElementById('rating-general-text');
                    ratingText.textContent = ratingTexts[rating];
                }
            }
            
            // Inicializar todas las estrellas
            document.querySelectorAll('.rating-stars').forEach(ratingGroup => {
                const target = ratingGroup.id.split('-')[1];
                updateStars(target, 5); // Iniciar con 5 estrellas
            });
            
            // Event listeners para los botones de estrellas
            document.querySelectorAll('.star-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const target = this.getAttribute('data-target');
                    updateStars(target, rating);
                });
                
                // Efecto hover
                button.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const target = this.getAttribute('data-target');
                    const stars = document.querySelectorAll(`#rating-${target} .star-btn`);
                    
                    stars.forEach((star, index) => {
                        const starRating = parseInt(star.getAttribute('data-rating'));
                        const starIcon = star.querySelector('i');
                        
                        if (starRating <= rating) {
                            starIcon.classList.add('text-yellow-400');
                            starIcon.classList.remove('text-gray-300');
                        } else {
                            starIcon.classList.remove('text-yellow-400');
                            starIcon.classList.add('text-gray-300');
                        }
                    });
                    
                    if (target === 'general') {
                        const ratingText = document.getElementById('rating-general-text');
                        ratingText.textContent = ratingTexts[rating];
                    }
                });
                
                // Restaurar al salir sin clic
                const ratingGroup = button.closest('.rating-stars');
                ratingGroup.addEventListener('mouseleave', function() {
                    const target = this.id.split('-')[1];
                    const input = document.getElementById(`calificacion-${target}-input`);
                    const currentRating = parseInt(input.value);
                    updateStars(target, currentRating);
                });
            });
            
            // Vista previa de imágenes
            const fotosInput = document.getElementById('fotos');
            const previewContainer = document.getElementById('preview-container');
            
            fotosInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                
                if (this.files) {
                    Array.from(this.files).forEach(file => {
                        if (!file.type.match('image.*')) {
                            return;
                        }
                        
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const previewWrapper = document.createElement('div');
                            previewWrapper.className = 'relative';
                            
                            const previewImg = document.createElement('img');
                            previewImg.src = e.target.result;
                            previewImg.className = 'w-24 h-24 object-cover rounded-md';
                            
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600';
                            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                            removeBtn.addEventListener('click', function() {
                                previewWrapper.remove();
                                // Nota: Esto no elimina el archivo del input, solo de la vista previa
                            });
                            
                            previewWrapper.appendChild(previewImg);
                            previewWrapper.appendChild(removeBtn);
                            previewContainer.appendChild(previewWrapper);
                        };
                        
                        reader.readAsDataURL(file);
                    });
                }
            });
        });
    </script>
@endsection