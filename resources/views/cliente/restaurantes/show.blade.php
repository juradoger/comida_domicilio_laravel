@extends('Layouts.cliente')

@section('title', 'Detalle de Restaurante')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Información del Restaurante -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="relative">
                <img src="{{ asset('img/restaurants/burger-king-banner.jpg') }}" alt="Burger King"
                    class="w-full h-64 object-cover"
                    onerror="this.src='https://via.placeholder.com/1200x400?text=Burger+King'">
                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-6">
                    <div class="flex items-center">
                        <img src="{{ asset('img/restaurants/burger-king-logo.jpg') }}" alt="Logo"
                            class="w-20 h-20 rounded-full border-4 border-white mr-4"
                            onerror="this.src='https://via.placeholder.com/80?text=BK'">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-1">Burger King</h1>
                            <div class="flex items-center text-white">
                                <span class="flex items-center mr-4">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.8</span>
                                    <span class="text-sm ml-1">(256 calificaciones)</span>
                                </span>
                                <span class="flex items-center mr-4">
                                    <i class="fas fa-clock text-yellow-400 mr-1"></i>
                                    <span>25-35 min</span>
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-yellow-400 mr-1"></i>
                                    <span>1.2 km</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Comida Rápida</span>
                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Hamburguesas</span>
                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Pollo</span>
                    <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">Envío Gratis</span>
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Abierto ahora</span>
                </div>

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">
                    <div>
                        <p class="text-gray-600"><i class="fas fa-map-marker-alt text-orange-500 mr-1"></i> Av. Principal
                            123, Lima</p>
                        <p class="text-gray-600"><i class="fas fa-clock text-orange-500 mr-1"></i> Horario: 10:00 AM - 10:00
                            PM</p>
                        <p class="text-gray-600"><i class="fas fa-money-bill-wave text-orange-500 mr-1"></i> Pedido mínimo:
                            Bs. 20.00</p>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="bg-white border border-orange-500 text-orange-500 hover:bg-orange-50 px-4 py-2 rounded-md flex items-center">
                            <i class="far fa-heart mr-2"></i> Favorito
                        </button>
                        <button
                            class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md flex items-center">
                            <i class="fas fa-share-alt mr-2"></i> Compartir
                        </button>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Acerca de</h3>
                    <p class="text-gray-600">Burger King es una cadena de restaurantes de comida rápida estadounidense
                        fundada en 1953. Nos especializamos en hamburguesas a la parrilla, papas fritas, refrescos, postres
                        y, recientemente, ensaladas y wraps. Nuestro compromiso es ofrecer los mejores productos con los
                        ingredientes más frescos.</p>
                </div>
            </div>
        </div>

        <!-- Menú y Carrito -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Menú -->
            <div class="lg:w-2/3">
                <!-- Barra de búsqueda -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div class="relative">
                        <input type="text" id="search-menu" placeholder="Buscar en el menú..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Categorías del Menú -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Categorías</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex overflow-x-auto pb-2 gap-2 categories-scroll">
                            <a href="#hamburguesas"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-orange-500 text-white">Hamburguesas</a>
                            <a href="#combos"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Combos</a>
                            <a href="#pollo"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Pollo</a>
                            <a href="#acompañamientos"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Acompañamientos</a>
                            <a href="#ensaladas"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Ensaladas</a>
                            <a href="#postres"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Postres</a>
                            <a href="#bebidas"
                                class="category-btn whitespace-nowrap px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-orange-500 hover:text-white">Bebidas</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Hamburguesas -->
                <div id="hamburguesas" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Hamburguesas</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid gap-4">
                            <!-- Producto 1 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/whopper.jpg') }}" alt="Whopper"
                                        class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Whopper'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper</h4>
                                    <p class="text-gray-600 text-sm mb-2">Hamburguesa con carne a la parrilla, lechuga,
                                        tomate, cebolla, pepinillos, mayonesa y ketchup en pan con semillas de sésamo.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 670 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 15.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="1" data-name="Whopper" data-price="15.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>

                            <!-- Producto 2 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/whopper-doble.jpg') }}" alt="Whopper Doble"
                                        class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Whopper+Doble'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper Doble</h4>
                                    <p class="text-gray-600 text-sm mb-2">Doble carne a la parrilla, doble queso, lechuga,
                                        tomate, cebolla, pepinillos, mayonesa y ketchup en pan con semillas de sésamo.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 900 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 22.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="2" data-name="Whopper Doble" data-price="22.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>

                            <!-- Producto 3 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/whopper-jr.jpg') }}" alt="Whopper Jr."
                                        class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Whopper+Jr'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper Jr.</h4>
                                    <p class="text-gray-600 text-sm mb-2">Versión más pequeña de la Whopper clásica con los
                                        mismos ingredientes: carne a la parrilla, lechuga, tomate, cebolla, pepinillos,
                                        mayonesa y ketchup.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 450 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 12.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="3" data-name="Whopper Jr." data-price="12.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Combos -->
                <div id="combos" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Combos</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid gap-4">
                            <!-- Combo 1 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/combo-whopper.jpg') }}" alt="Combo Whopper"
                                        class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Combo+Whopper'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Combo Whopper</h4>
                                    <p class="text-gray-600 text-sm mb-2">Hamburguesa Whopper, papas medianas y bebida
                                        mediana a elección.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 1100 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 25.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="4" data-name="Combo Whopper" data-price="25.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>

                            <!-- Combo 2 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/combo-whopper-doble.jpg') }}"
                                        alt="Combo Whopper Doble" class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Combo+Whopper+Doble'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Combo Whopper Doble</h4>
                                    <p class="text-gray-600 text-sm mb-2">Hamburguesa Whopper Doble, papas grandes y bebida
                                        grande a elección.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 1450 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 32.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="5" data-name="Combo Whopper Doble" data-price="32.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>

                            <!-- Combo 3 -->
                            <div
                                class="menu-item flex flex-col md:flex-row border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                                <div class="md:w-1/4 mb-4 md:mb-0">
                                    <img src="{{ asset('img/products/combo-king.jpg') }}" alt="Combo King"
                                        class="w-full h-32 object-cover rounded-lg"
                                        onerror="this.src='https://via.placeholder.com/300x200?text=Combo+King'">
                                </div>
                                <div class="md:w-2/4 md:px-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-1">Combo King</h4>
                                    <p class="text-gray-600 text-sm mb-2">Hamburguesa King de Pollo, papas medianas y
                                        bebida mediana a elección.</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-fire text-orange-500 mr-1"></i> 1050 cal
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock text-orange-500 mr-1"></i> 10-15 min
                                        </span>
                                    </div>
                                </div>
                                <div class="md:w-1/4 flex flex-col items-end justify-between">
                                    <div class="text-lg font-bold text-gray-800 mb-2">Bs. 27.90</div>
                                    <button
                                        class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full md:w-auto text-center"
                                        data-id="6" data-name="Combo King" data-price="27.90">
                                        <i class="fas fa-plus mr-1"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Más secciones del menú se agregarían aquí -->
            </div>

            <!-- Carrito -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-4">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Tu Pedido</h3>
                    </div>
                    <div id="cart-items" class="p-4 max-h-80 overflow-y-auto">
                        <!-- Los items del carrito se cargarán dinámicamente aquí -->
                        <div class="text-center text-gray-500 py-8" id="empty-cart-message">
                            <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                            <p>Tu carrito está vacío</p>
                            <p class="text-sm">Agrega productos del menú para comenzar tu pedido</p>
                        </div>
                    </div>
                    <div class="p-4 border-t">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium" id="subtotal">Bs. 0.00</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Costo de envío:</span>
                            <span class="font-medium" id="shipping">Bs. 5.00</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Descuento:</span>
                            <span class="font-medium text-green-600" id="discount">-Bs. 0.00</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold mb-4">
                            <span>Total:</span>
                            <span id="total">Bs. 5.00</span>
                        </div>
                        <a href="{{ route('cliente.carrito.index') }}"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-md w-full block text-center font-medium">
                            Proceder al Pago
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reseñas y Calificaciones -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-8">
            <div class="p-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Reseñas y Calificaciones</h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Resumen de Calificaciones -->
                    <div class="md:w-1/3">
                        <div class="text-center mb-4">
                            <div class="text-5xl font-bold text-gray-800 mb-2">4.8</div>
                            <div class="flex justify-center mb-2">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            </div>
                            <p class="text-gray-600">Basado en 256 reseñas</p>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="text-sm w-8">5 <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="text-sm text-gray-600">75%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm w-8">4 <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 18%"></div>
                                </div>
                                <span class="text-sm text-gray-600">18%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm w-8">3 <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 5%"></div>
                                </div>
                                <span class="text-sm text-gray-600">5%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm w-8">2 <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 1%"></div>
                                </div>
                                <span class="text-sm text-gray-600">1%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm w-8">1 <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 1%"></div>
                                </div>
                                <span class="text-sm text-gray-600">1%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Reseñas -->
                    <div class="md:w-2/3">
                        <div class="space-y-6">
                            <!-- Reseña 1 -->
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold mr-3">
                                            JD</div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">Juan Pérez</h4>
                                            <p class="text-sm text-gray-500">Hace 2 días</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                </div>
                                <p class="text-gray-600">Las hamburguesas son excelentes, siempre calientes y con
                                    ingredientes frescos. El servicio de delivery es rápido y el pedido llegó antes de lo
                                    esperado. ¡Definitivamente volveré a pedir!</p>
                            </div>

                            <!-- Reseña 2 -->
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold mr-3">
                                            MR</div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">María Rodríguez</h4>
                                            <p class="text-sm text-gray-500">Hace 1 semana</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="far fa-star text-yellow-400"></i>
                                    </div>
                                </div>
                                <p class="text-gray-600">Muy buena comida, pero el tiempo de entrega fue un poco más largo
                                    de lo esperado. Las papas llegaron un poco frías, pero la hamburguesa estaba perfecta.
                                    El repartidor fue muy amable.</p>
                            </div>

                            <!-- Reseña 3 -->
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold mr-3">
                                            CL</div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">Carlos López</h4>
                                            <p class="text-sm text-gray-500">Hace 2 semanas</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                </div>
                                <p class="text-gray-600">¡La mejor hamburguesa que he probado! El combo Whopper Doble es
                                    increíble y vale cada centavo. La aplicación es muy fácil de usar y el seguimiento del
                                    pedido es excelente. Recomiendo 100%.</p>
                            </div>
                        </div>

                        <!-- Ver más reseñas -->
                        <div class="mt-6 text-center">
                            <button class="text-orange-500 hover:text-orange-700 font-medium">Ver más reseñas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables para el carrito
            let cartItems = [];
            const cartItemsContainer = document.getElementById('cart-items');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            const subtotalElement = document.getElementById('subtotal');
            const shippingElement = document.getElementById('shipping');
            const discountElement = document.getElementById('discount');
            const totalElement = document.getElementById('total');

            // Función para actualizar el carrito
            function updateCart() {
                // Limpiar el contenedor del carrito
                while (cartItemsContainer.firstChild) {
                    cartItemsContainer.removeChild(cartItemsContainer.firstChild);
                }

                // Mostrar mensaje de carrito vacío si no hay items
                if (cartItems.length === 0) {
                    cartItemsContainer.appendChild(emptyCartMessage);
                    subtotalElement.textContent = 'Bs. 0.00';
                    totalElement.textContent = 'Bs. 5.00'; // Solo costo de envío
                    return;
                }

                // Ocultar mensaje de carrito vacío
                emptyCartMessage.remove();

                // Calcular subtotal
                let subtotal = 0;

                // Agregar cada item al carrito
                cartItems.forEach((item, index) => {
                    subtotal += item.price * item.quantity;

                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex justify-between items-center py-2 border-b last:border-0';
                    itemElement.innerHTML = `
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">${item.name}</h4>
                            <div class="flex items-center mt-1">
                                <button class="decrease-quantity bg-gray-200 hover:bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center" data-index="${index}">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="increase-quantity bg-gray-200 hover:bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center" data-index="${index}">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-medium">Bs. ${(item.price * item.quantity).toFixed(2)}</div>
                            <button class="remove-item text-red-500 hover:text-red-700 text-sm mt-1" data-index="${index}">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </div>
                    `;

                    cartItemsContainer.appendChild(itemElement);
                });

                // Actualizar totales
                const shipping = 5.00;
                const discount = 0.00; // Podría calcularse según promociones
                const total = subtotal + shipping - discount;

                subtotalElement.textContent = `Bs. ${subtotal.toFixed(2)}`;
                shippingElement.textContent = `Bs. ${shipping.toFixed(2)}`;
                discountElement.textContent = `-Bs. ${discount.toFixed(2)}`;
                totalElement.textContent = `Bs. ${total.toFixed(2)}`;

                // Agregar event listeners a los botones
                document.querySelectorAll('.decrease-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        if (cartItems[index].quantity > 1) {
                            cartItems[index].quantity--;
                        } else {
                            cartItems.splice(index, 1);
                        }
                        updateCart();
                    });
                });

                document.querySelectorAll('.increase-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        cartItems[index].quantity++;
                        updateCart();
                    });
                });

                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        cartItems.splice(index, 1);
                        updateCart();
                    });
                });
            }

            // Event listener para agregar items al carrito
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = parseFloat(this.getAttribute('data-price'));

                    // Verificar si el item ya está en el carrito
                    const existingItemIndex = cartItems.findIndex(item => item.id === id);

                    if (existingItemIndex !== -1) {
                        // Incrementar cantidad si ya existe
                        cartItems[existingItemIndex].quantity++;
                    } else {
                        // Agregar nuevo item si no existe
                        cartItems.push({
                            id: id,
                            name: name,
                            price: price,
                            quantity: 1
                        });
                    }

                    // Mostrar notificación
                    const notification = document.createElement('div');
                    notification.className =
                        'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50';
                    notification.innerHTML =
                        `<i class="fas fa-check mr-2"></i> ${name} agregado al carrito`;
                    document.body.appendChild(notification);

                    // Eliminar notificación después de 3 segundos
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);

                    // Actualizar carrito
                    updateCart();
                });
            });

            // Navegación suave al hacer clic en las categorías
            document.querySelectorAll('.category-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);

                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Actualizar estado activo de los botones
                    document.querySelectorAll('.category-btn').forEach(btn => {
                        btn.classList.remove('bg-orange-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });

                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-orange-500', 'text-white');
                });
            });

            // Búsqueda en el menú
            const searchInput = document.getElementById('search-menu');
            const menuItems = document.querySelectorAll('.menu-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                menuItems.forEach(item => {
                    const itemName = item.querySelector('h4').textContent.toLowerCase();
                    const itemDescription = item.querySelector('p').textContent.toLowerCase();

                    if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Inicializar carrito
            updateCart();
        });
    </script>
@endsection
