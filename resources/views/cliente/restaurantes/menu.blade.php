@extends('Layouts.cliente')

@section('title', 'Menú del Restaurante')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Encabezado del Restaurante -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="relative">
                <img src="{{ asset('img/restaurants/burger-king-banner.jpg') }}" alt="Burger King"
                    class="w-full h-48 object-cover"
                    onerror="this.src='https://via.placeholder.com/1200x300?text=Burger+King'">
                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-6">
                    <div class="flex items-center">
                        <img src="{{ asset('img/restaurants/burger-king-logo.jpg') }}" alt="Logo"
                            class="w-16 h-16 rounded-full border-4 border-white mr-4"
                            onerror="this.src='https://via.placeholder.com/80?text=BK'">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-1">Burger King</h1>
                            <div class="flex items-center text-white text-sm">
                                <span class="flex items-center mr-4">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.8</span>
                                </span>
                                <span class="flex items-center mr-4">
                                    <i class="fas fa-clock text-yellow-400 mr-1"></i>
                                    <span>25-35 min</span>
                                </span>
                                <a href="{{ route('cliente.restaurantes.show', 1) }}"
                                    class="text-white hover:text-orange-200">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver al restaurante
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Navegación de Categorías (Sidebar) -->
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-4">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Categorías</h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-2">
                            <a href="#hamburguesas"
                                class="category-link block px-4 py-2 rounded-md bg-orange-500 text-white hover:bg-orange-600 transition duration-200">Hamburguesas</a>
                            <a href="#combos"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Combos</a>
                            <a href="#pollo"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Pollo</a>
                            <a href="#acompañamientos"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Acompañamientos</a>
                            <a href="#ensaladas"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Ensaladas</a>
                            <a href="#postres"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Postres</a>
                            <a href="#bebidas"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Bebidas</a>
                            <a href="#salsas"
                                class="category-link block px-4 py-2 rounded-md hover:bg-gray-100 transition duration-200">Salsas</a>
                        </div>
                    </div>
                </div>

                <!-- Carrito Resumen -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mt-4 sticky top-80">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Tu Pedido</h3>
                    </div>
                    <div class="p-4">
                        <div id="cart-summary">
                            <p class="text-center text-gray-500" id="empty-cart-message">No hay productos en tu carrito</p>
                            <!-- Los items del carrito se mostrarán aquí -->
                        </div>
                        <div class="mt-4 pt-4 border-t" id="cart-totals" style="display: none;">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium" id="subtotal">Bs. 0.00</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mb-4">
                                <span>Productos:</span>
                                <span id="item-count">0</span>
                            </div>
                            <a href="{{ route('cliente.carrito.index') }}"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md w-full block text-center font-medium">
                                Ver Carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido del Menú -->
            <div class="md:w-3/4">
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

                <!-- Sección Hamburguesas -->
                <div id="hamburguesas" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Hamburguesas</h3>
                        <p class="text-gray-600 text-sm">Nuestras hamburguesas a la parrilla con los mejores ingredientes
                        </p>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Producto 1 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/whopper.jpg') }}" alt="Whopper"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Whopper'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 15.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa con carne a la parrilla, lechuga,
                                            tomate, cebolla, pepinillos, mayonesa y ketchup.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="1" data-name="Whopper" data-price="15.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 2 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/whopper-doble.jpg') }}" alt="Whopper Doble"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Whopper+Doble'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper Doble</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 22.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Doble carne a la parrilla, doble queso,
                                            lechuga, tomate, cebolla, pepinillos, mayonesa y ketchup.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="2" data-name="Whopper Doble" data-price="22.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 3 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/whopper-jr.jpg') }}" alt="Whopper Jr."
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Whopper+Jr'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Whopper Jr.</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 12.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Versión más pequeña de la Whopper clásica con
                                            los mismos ingredientes.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="3" data-name="Whopper Jr." data-price="12.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 4 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/steakhouse.jpg') }}" alt="Steakhouse"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Steakhouse'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Steakhouse</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 18.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa con carne a la parrilla, queso
                                            cheddar, tocino, cebolla caramelizada y salsa BBQ.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="4" data-name="Steakhouse" data-price="18.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 5 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/cheese-burger.jpg') }}" alt="Cheese Burger"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Cheese+Burger'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Cheese Burger</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 10.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa clásica con queso americano,
                                            pepinillos, ketchup y mostaza.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="5" data-name="Cheese Burger" data-price="10.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 6 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/double-cheese.jpg') }}" alt="Double Cheese"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Double+Cheese'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Double Cheese</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 14.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Doble carne, doble queso americano,
                                            pepinillos, ketchup y mostaza.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="6" data-name="Double Cheese" data-price="14.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Combos -->
                <div id="combos" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Combos</h3>
                        <p class="text-gray-600 text-sm">Nuestros combos incluyen papas y bebida</p>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Combo 1 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/combo-whopper.jpg') }}" alt="Combo Whopper"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Combo+Whopper'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Combo Whopper</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 25.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa Whopper, papas medianas y bebida
                                            mediana a elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="7" data-name="Combo Whopper" data-price="25.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Combo 2 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/combo-whopper-doble.jpg') }}"
                                            alt="Combo Whopper Doble" class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Combo+Whopper+Doble'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Combo Whopper Doble</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 32.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa Whopper Doble, papas grandes y
                                            bebida grande a elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="8" data-name="Combo Whopper Doble" data-price="32.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Combo 3 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/combo-king.jpg') }}" alt="Combo King"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Combo+King'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Combo King</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 27.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa King de Pollo, papas medianas y
                                            bebida mediana a elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="9" data-name="Combo King" data-price="27.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Combo 4 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/combo-steakhouse.jpg') }}"
                                            alt="Combo Steakhouse" class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Combo+Steakhouse'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Combo Steakhouse</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 28.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa Steakhouse, papas medianas y
                                            bebida mediana a elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="10" data-name="Combo Steakhouse" data-price="28.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Pollo -->
                <div id="pollo" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Pollo</h3>
                        <p class="text-gray-600 text-sm">Nuestras deliciosas opciones de pollo</p>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Producto 1 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/king-pollo.jpg') }}" alt="King de Pollo"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=King+de+Pollo'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">King de Pollo</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 16.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa de pollo crujiente con lechuga y
                                            mayonesa.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="11" data-name="King de Pollo" data-price="16.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 2 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/chicken-crispy.jpg') }}" alt="Chicken Crispy"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Chicken+Crispy'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Chicken Crispy</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 18.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Hamburguesa de pollo extra crujiente con
                                            lechuga, tomate y mayonesa especial.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="12" data-name="Chicken Crispy" data-price="18.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 3 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/chicken-nuggets.jpg') }}" alt="Chicken Nuggets"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Chicken+Nuggets'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Chicken Nuggets (8 unid)</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 12.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">8 piezas de nuggets de pollo con salsa a
                                            elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="13" data-name="Chicken Nuggets (8 unid)" data-price="12.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 4 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/chicken-nuggets-12.jpg') }}"
                                            alt="Chicken Nuggets 12" class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Chicken+Nuggets+12'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Chicken Nuggets (12 unid)</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 16.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">12 piezas de nuggets de pollo con salsa a
                                            elección.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="14" data-name="Chicken Nuggets (12 unid)" data-price="16.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Acompañamientos -->
                <div id="acompañamientos" class="menu-section bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-bold text-gray-800">Acompañamientos</h3>
                        <p class="text-gray-600 text-sm">Complementos perfectos para tu comida</p>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Producto 1 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/papas-pequeñas.jpg') }}" alt="Papas Pequeñas"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Papas+Pequeñas'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Papas Pequeñas</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 5.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Porción pequeña de papas fritas.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="15" data-name="Papas Pequeñas" data-price="5.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 2 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/papas-medianas.jpg') }}" alt="Papas Medianas"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Papas+Medianas'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Papas Medianas</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 7.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Porción mediana de papas fritas.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="16" data-name="Papas Medianas" data-price="7.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 3 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/papas-grandes.jpg') }}" alt="Papas Grandes"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Papas+Grandes'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Papas Grandes</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 9.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Porción grande de papas fritas.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="17" data-name="Papas Grandes" data-price="9.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto 4 -->
                            <div
                                class="menu-item bg-white border rounded-lg overflow-hidden hover:shadow-md transition duration-300">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <img src="{{ asset('img/products/aros-cebolla.jpg') }}" alt="Aros de Cebolla"
                                            class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150?text=Aros+de+Cebolla'">
                                    </div>
                                    <div class="w-2/3 p-4">
                                        <div class="flex justify-between">
                                            <h4 class="text-lg font-bold text-gray-800 mb-1">Aros de Cebolla</h4>
                                            <span class="text-lg font-bold text-gray-800">Bs. 10.90</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4">Aros de cebolla crujientes con salsa
                                            especial.</p>
                                        <button
                                            class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm"
                                            data-id="18" data-name="Aros de Cebolla" data-price="10.90">
                                            <i class="fas fa-plus mr-1"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Más secciones del menú se agregarían aquí -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables para el carrito
            let cartItems = [];
            const cartSummary = document.getElementById('cart-summary');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            const cartTotals = document.getElementById('cart-totals');
            const subtotalElement = document.getElementById('subtotal');
            const itemCountElement = document.getElementById('item-count');

            // Cargar carrito desde localStorage si existe
            if (localStorage.getItem('cartItems')) {
                try {
                    cartItems = JSON.parse(localStorage.getItem('cartItems'));
                    updateCartSummary();
                } catch (e) {
                    console.error('Error al cargar el carrito:', e);
                    localStorage.removeItem('cartItems');
                }
            }

            // Función para actualizar el resumen del carrito
            function updateCartSummary() {
                // Mostrar/ocultar elementos según si hay items en el carrito
                if (cartItems.length === 0) {
                    emptyCartMessage.style.display = 'block';
                    cartTotals.style.display = 'none';
                    return;
                }

                emptyCartMessage.style.display = 'none';
                cartTotals.style.display = 'block';

                // Limpiar el contenedor del resumen
                const itemsContainer = document.createElement('div');
                itemsContainer.className = 'space-y-2';

                // Calcular subtotal y contar items
                let subtotal = 0;
                let totalItems = 0;

                // Mostrar solo los primeros 3 items (o todos si hay menos)
                const displayItems = cartItems.slice(0, 3);

                // Agregar cada item al resumen
                displayItems.forEach(item => {
                    subtotal += item.price * item.quantity;
                    totalItems += item.quantity;

                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex justify-between items-center text-sm';
                    itemElement.innerHTML = `
                        <span>${item.quantity}x ${item.name}</span>
                        <span>Bs. ${(item.price * item.quantity).toFixed(2)}</span>
                    `;

                    itemsContainer.appendChild(itemElement);
                });

                // Si hay más items de los que se muestran, agregar indicador
                if (cartItems.length > 3) {
                    const moreItemsElement = document.createElement('div');
                    moreItemsElement.className = 'text-center text-sm text-gray-500 mt-2';
                    moreItemsElement.textContent = `Y ${cartItems.length - 3} productos más...`;
                    itemsContainer.appendChild(moreItemsElement);
                }

                // Reemplazar el contenido del resumen
                cartSummary.innerHTML = '';
                cartSummary.appendChild(itemsContainer);

                // Actualizar totales
                subtotalElement.textContent = `Bs. ${subtotal.toFixed(2)}`;
                itemCountElement.textContent = totalItems;

                // Guardar carrito en localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
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
                    updateCartSummary();
                });
            });

            // Navegación suave al hacer clic en las categorías
            document.querySelectorAll('.category-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);

                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Actualizar estado activo de los enlaces
                    document.querySelectorAll('.category-link').forEach(l => {
                        l.classList.remove('bg-orange-500', 'text-white');
                        l.classList.add('hover:bg-gray-100');
                    });

                    this.classList.remove('hover:bg-gray-100');
                    this.classList.add('bg-orange-500', 'text-white');
                });
            });

            // Búsqueda en el menú
            const searchInput = document.getElementById('search-menu');
            const menuItems = document.querySelectorAll('.menu-item');
            const menuSections = document.querySelectorAll('.menu-section');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasResults = false;

                menuItems.forEach(item => {
                    const itemName = item.querySelector('h4').textContent.toLowerCase();
                    const itemDescription = item.querySelector('p').textContent.toLowerCase();

                    if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                        item.style.display = 'flex';
                        hasResults = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Mostrar/ocultar secciones según si tienen resultados
                menuSections.forEach(section => {
                    const visibleItems = section.querySelectorAll(
                        '.menu-item[style="display: flex;"]');
                    if (visibleItems.length > 0) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });

            // Detectar scroll para resaltar categoría actual
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;

                // Encontrar la sección visible más cercana al borde superior
                let currentSection = null;
                let minDistance = Number.MAX_VALUE;

                menuSections.forEach(section => {
                    if (section.style.display !== 'none') {
                        const distance = Math.abs(section.getBoundingClientRect().top - 100);
                        if (distance < minDistance) {
                            minDistance = distance;
                            currentSection = section.id;
                        }
                    }
                });

                // Actualizar estado activo de los enlaces
                if (currentSection) {
                    document.querySelectorAll('.category-link').forEach(link => {
                        link.classList.remove('bg-orange-500', 'text-white');
                        link.classList.add('hover:bg-gray-100');

                        if (link.getAttribute('href') === `#${currentSection}`) {
                            link.classList.remove('hover:bg-gray-100');
                            link.classList.add('bg-orange-500', 'text-white');
                        }
                    });
                }
            });
        });
    </script>
@endsection
