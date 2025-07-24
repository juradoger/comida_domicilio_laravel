@extends('Layouts.cliente')

@section('title', 'Restaurantes Asociados')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Restaurantes Asociados</h2>
        </div>
        
        <!-- Filtros y Búsqueda -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Búsqueda -->
                    <div class="md:w-1/3">
                        <div class="relative">
                            <input type="text" id="search-restaurant" placeholder="Buscar restaurante..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 pl-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtros -->
                    <div class="flex flex-wrap gap-2">
                        <select id="filter-category" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                            <option value="">Todas las categorías</option>
                            <option value="comida-rapida">Comida Rápida</option>
                            <option value="pizza">Pizza</option>
                            <option value="sushi">Sushi</option>
                            <option value="china">Comida China</option>
                            <option value="italiana">Comida Italiana</option>
                            <option value="peruana">Comida Peruana</option>
                            <option value="saludable">Comida Saludable</option>
                            <option value="postres">Postres</option>
                        </select>
                        
                        <select id="filter-rating" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                            <option value="">Todas las calificaciones</option>
                            <option value="5">5 estrellas</option>
                            <option value="4">4+ estrellas</option>
                            <option value="3">3+ estrellas</option>
                        </select>
                        
                        <select id="filter-delivery-time" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                            <option value="">Cualquier tiempo de entrega</option>
                            <option value="15">Menos de 15 minutos</option>
                            <option value="30">Menos de 30 minutos</option>
                            <option value="45">Menos de 45 minutos</option>
                        </select>
                    </div>
                    
                    <!-- Ordenar por -->
                    <div>
                        <select id="sort-by" class="rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                            <option value="popular">Más populares</option>
                            <option value="rating">Mejor calificados</option>
                            <option value="delivery-time">Tiempo de entrega</option>
                            <option value="min-order">Pedido mínimo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Categorías Destacadas -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Categorías Destacadas</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="comida-rapida">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-hamburger text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Comida Rápida</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="pizza">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-pizza-slice text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Pizza</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="sushi">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-fish text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sushi</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="china">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-utensils text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">China</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="italiana">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-cheese text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Italiana</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="peruana">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-pepper-hot text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Peruana</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="saludable">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-seedling text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Saludable</h4>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300" data-category="postres">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-2">
                            <i class="fas fa-ice-cream text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Postres</h4>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Restaurantes Destacados -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Restaurantes Destacados</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Restaurante 1 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="comida-rapida" data-rating="4.8" data-delivery-time="25">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/burger-king.jpg') }}" alt="Burger King" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=Burger+King'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.8
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 25-35 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">Burger King</h4>
                                <p class="text-gray-600 text-sm mb-2">Comida Rápida, Hamburguesas</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                Envío Gratis
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Av. Principal 123</span>
                            <span class="mx-2">•</span>
                            <span>1.2 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 20.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
                
                <!-- Restaurante 2 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="pizza" data-rating="4.5" data-delivery-time="30">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/pizza-hut.jpg') }}" alt="Pizza Hut" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=Pizza+Hut'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.5
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 30-40 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">Pizza Hut</h4>
                                <p class="text-gray-600 text-sm mb-2">Pizza, Italiana</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                10% Descuento
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Calle Secundaria 456</span>
                            <span class="mx-2">•</span>
                            <span>2.5 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 25.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
                
                <!-- Restaurante 3 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="sushi" data-rating="4.9" data-delivery-time="40">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/sushi-express.jpg') }}" alt="Sushi Express" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=Sushi+Express'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.9
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 40-50 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">Sushi Express</h4>
                                <p class="text-gray-600 text-sm mb-2">Sushi, Japonesa</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                Nuevo
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Av. Central 789</span>
                            <span class="mx-2">•</span>
                            <span>3.0 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 35.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
                
                <!-- Restaurante 4 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="china" data-rating="4.3" data-delivery-time="35">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/china-wok.jpg') }}" alt="China Wok" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=China+Wok'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.3
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 35-45 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">China Wok</h4>
                                <p class="text-gray-600 text-sm mb-2">China, Asiática</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                Envío Gratis
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Jr. Comercial 234</span>
                            <span class="mx-2">•</span>
                            <span>1.8 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 30.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
                
                <!-- Restaurante 5 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="italiana" data-rating="4.7" data-delivery-time="45">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/la-trattoria.jpg') }}" alt="La Trattoria" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=La+Trattoria'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.7
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 45-55 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">La Trattoria</h4>
                                <p class="text-gray-600 text-sm mb-2">Italiana, Pasta</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                15% Descuento
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Av. Italia 567</span>
                            <span class="mx-2">•</span>
                            <span>4.2 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 40.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
                
                <!-- Restaurante 6 -->
                <div class="restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-category="peruana" data-rating="4.9" data-delivery-time="40">
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/el-aji.jpg') }}" alt="El Ají" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=El+Aji'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> 4.9
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> 40-50 min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">El Ají</h4>
                                <p class="text-gray-600 text-sm mb-2">Peruana, Criolla</p>
                            </div>
                            <div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">
                                Popular
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>Jr. Perú 890</span>
                            <span class="mx-2">•</span>
                            <span>2.7 km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. 35.00</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Todos los Restaurantes -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Todos los Restaurantes</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="all-restaurants">
                <!-- Los restaurantes se cargarán dinámicamente aquí -->
            </div>
            
            <!-- Paginación -->
            <div class="mt-8 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">1</a>
                    <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-orange-500 text-white">2</a>
                    <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">3</a>
                    <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">4</a>
                    <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">5</a>
                    <a href="#" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datos de ejemplo para restaurantes adicionales
            const restaurantsData = [
                {
                    name: "McDonald's",
                    image: "mcdonalds.jpg",
                    rating: 4.6,
                    deliveryTime: "20-30",
                    category: "comida-rapida",
                    tags: "Comida Rápida, Hamburguesas",
                    promo: "Envío Gratis",
                    address: "Av. Central 123",
                    distance: "0.8",
                    minOrder: 18.00
                },
                {
                    name: "KFC",
                    image: "kfc.jpg",
                    rating: 4.4,
                    deliveryTime: "25-35",
                    category: "comida-rapida",
                    tags: "Comida Rápida, Pollo",
                    promo: "2x1 Martes",
                    address: "Jr. Comercial 456",
                    distance: "1.5",
                    minOrder: 20.00
                },
                {
                    name: "Papa John's",
                    image: "papa-johns.jpg",
                    rating: 4.7,
                    deliveryTime: "30-40",
                    category: "pizza",
                    tags: "Pizza, Italiana",
                    promo: "20% Descuento",
                    address: "Av. Las Pizzas 789",
                    distance: "2.2",
                    minOrder: 25.00
                },
                {
                    name: "Domino's Pizza",
                    image: "dominos.jpg",
                    rating: 4.3,
                    deliveryTime: "25-35",
                    category: "pizza",
                    tags: "Pizza, Italiana",
                    promo: "",
                    address: "Calle Secundaria 234",
                    distance: "1.9",
                    minOrder: 22.00
                },
                {
                    name: "Makoto Sushi",
                    image: "makoto.jpg",
                    rating: 4.8,
                    deliveryTime: "35-45",
                    category: "sushi",
                    tags: "Sushi, Japonesa",
                    promo: "Envío Gratis",
                    address: "Jr. Japón 567",
                    distance: "3.5",
                    minOrder: 40.00
                },
                {
                    name: "Chifa Express",
                    image: "chifa-express.jpg",
                    rating: 4.2,
                    deliveryTime: "30-40",
                    category: "china",
                    tags: "China, Asiática",
                    promo: "",
                    address: "Av. Oriental 890",
                    distance: "2.1",
                    minOrder: 25.00
                },
                {
                    name: "Don Italiano",
                    image: "don-italiano.jpg",
                    rating: 4.6,
                    deliveryTime: "40-50",
                    category: "italiana",
                    tags: "Italiana, Pasta",
                    promo: "10% Descuento",
                    address: "Calle Roma 123",
                    distance: "3.8",
                    minOrder: 35.00
                },
                {
                    name: "El Cevichero",
                    image: "el-cevichero.jpg",
                    rating: 4.9,
                    deliveryTime: "35-45",
                    category: "peruana",
                    tags: "Peruana, Mariscos",
                    promo: "Popular",
                    address: "Av. Marina 456",
                    distance: "2.9",
                    minOrder: 38.00
                },
                {
                    name: "Green Life",
                    image: "green-life.jpg",
                    rating: 4.5,
                    deliveryTime: "25-35",
                    category: "saludable",
                    tags: "Saludable, Vegana",
                    promo: "Nuevo",
                    address: "Jr. Saludable 789",
                    distance: "1.7",
                    minOrder: 30.00
                }
            ];
            
            const allRestaurantsContainer = document.getElementById('all-restaurants');
            
            // Cargar restaurantes adicionales
            restaurantsData.forEach(restaurant => {
                const restaurantCard = document.createElement('div');
                restaurantCard.className = 'restaurant-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300';
                restaurantCard.setAttribute('data-category', restaurant.category);
                restaurantCard.setAttribute('data-rating', restaurant.rating);
                restaurantCard.setAttribute('data-delivery-time', restaurant.deliveryTime.split('-')[0]);
                
                restaurantCard.innerHTML = `
                    <div class="relative">
                        <img src="{{ asset('img/restaurants/${restaurant.image}') }}" alt="${restaurant.name}" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x200?text=${encodeURIComponent(restaurant.name)}'">
                        <div class="absolute top-0 right-0 bg-orange-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> ${restaurant.rating}
                        </div>
                        <div class="absolute bottom-0 left-0 bg-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                            <i class="fas fa-clock mr-1 text-orange-500"></i> ${restaurant.deliveryTime} min
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 mb-1">${restaurant.name}</h4>
                                <p class="text-gray-600 text-sm mb-2">${restaurant.tags}</p>
                            </div>
                            ${restaurant.promo ? `<div class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">${restaurant.promo}</div>` : ''}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-1"></i>
                            <span>${restaurant.address}</span>
                            <span class="mx-2">•</span>
                            <span>${restaurant.distance} km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedido mínimo: S/. ${restaurant.minOrder.toFixed(2)}</span>
                            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm">Ver Menú</a>
                        </div>
                    </div>
                `;
                
                allRestaurantsContainer.appendChild(restaurantCard);
            });
            
            // Filtrar por categoría al hacer clic en las tarjetas de categoría
            const categoryCards = document.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    e.preventDefault();
                    const category = this.getAttribute('data-category');
                    document.getElementById('filter-category').value = category;
                    filterRestaurants();
                });
            });
            
            // Filtrar restaurantes según los filtros seleccionados
            const searchInput = document.getElementById('search-restaurant');
            const filterCategory = document.getElementById('filter-category');
            const filterRating = document.getElementById('filter-rating');
            const filterDeliveryTime = document.getElementById('filter-delivery-time');
            const sortBy = document.getElementById('sort-by');
            
            searchInput.addEventListener('input', filterRestaurants);
            filterCategory.addEventListener('change', filterRestaurants);
            filterRating.addEventListener('change', filterRestaurants);
            filterDeliveryTime.addEventListener('change', filterRestaurants);
            sortBy.addEventListener('change', filterRestaurants);
            
            function filterRestaurants() {
                const searchTerm = searchInput.value.toLowerCase();
                const category = filterCategory.value;
                const rating = parseFloat(filterRating.value) || 0;
                const deliveryTime = parseInt(filterDeliveryTime.value) || 999;
                const sort = sortBy.value;
                
                const allRestaurants = document.querySelectorAll('.restaurant-card');
                
                allRestaurants.forEach(restaurant => {
                    const restaurantName = restaurant.querySelector('h4').textContent.toLowerCase();
                    const restaurantCategory = restaurant.getAttribute('data-category');
                    const restaurantRating = parseFloat(restaurant.getAttribute('data-rating'));
                    const restaurantDeliveryTime = parseInt(restaurant.getAttribute('data-delivery-time'));
                    
                    const matchesSearch = restaurantName.includes(searchTerm);
                    const matchesCategory = category === '' || restaurantCategory === category;
                    const matchesRating = restaurantRating >= rating;
                    const matchesDeliveryTime = restaurantDeliveryTime <= deliveryTime;
                    
                    if (matchesSearch && matchesCategory && matchesRating && matchesDeliveryTime) {
                        restaurant.classList.remove('hidden');
                    } else {
                        restaurant.classList.add('hidden');
                    }
                });
                
                // Ordenar restaurantes
                const restaurantContainer = document.getElementById('all-restaurants');
                const restaurants = Array.from(restaurantContainer.children);
                
                restaurants.sort((a, b) => {
                    if (sort === 'rating') {
                        return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                    } else if (sort === 'delivery-time') {
                        return parseInt(a.getAttribute('data-delivery-time')) - parseInt(b.getAttribute('data-delivery-time'));
                    } else if (sort === 'min-order') {
                        const aOrder = parseFloat(a.querySelector('span:last-of-type').textContent.replace('Pedido mínimo: S/. ', ''));
                        const bOrder = parseFloat(b.querySelector('span:last-of-type').textContent.replace('Pedido mínimo: S/. ', ''));
                        return aOrder - bOrder;
                    } else { // popular (default)
                        return 0; // Mantener el orden actual
                    }
                });
                
                // Reordenar los elementos en el DOM
                restaurants.forEach(restaurant => {
                    restaurantContainer.appendChild(restaurant);
                });
            }
        });
    </script>
@endsection