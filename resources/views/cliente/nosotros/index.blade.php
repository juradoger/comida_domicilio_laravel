@extends('Layouts.cliente')

@section('title', 'Sobre Nosotros')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Sobre Nosotros</h2>
        </div>
        
        <!-- Banner Principal -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="relative">
                <img src="{{ asset('img/about-banner.jpg') }}" alt="Nuestro equipo" class="w-full h-64 object-cover" onerror="this.src='https://via.placeholder.com/1200x400?text=Comida+a+Domicilio'">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white mb-2">Comida a Domicilio</h3>
                        <p class="text-xl text-white">Llevando sabor a tu hogar desde 2015</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Nuestra Historia -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Nuestra Historia</h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/2">
                        <p class="text-gray-600 mb-4">
                            Comida a Domicilio nació en 2015 con una idea simple pero poderosa: hacer que la comida de calidad sea accesible para todos, en cualquier momento y lugar. Todo comenzó cuando nuestro fundador, Juan Pérez, un apasionado de la gastronomía y la tecnología, se dio cuenta de que había una brecha entre los restaurantes locales de alta calidad y los consumidores que buscaban comodidad sin sacrificar el sabor.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Lo que comenzó como un pequeño emprendimiento con apenas 5 restaurantes asociados y un equipo de 3 personas, ha crecido hasta convertirse en una plataforma líder en el mercado de delivery de comida, conectando a más de 500 restaurantes con miles de clientes satisfechos en todo el país.
                        </p>
                        <p class="text-gray-600">
                            A lo largo de estos años, hemos superado numerosos desafíos, desde la logística de entregas hasta la implementación de tecnología de vanguardia, siempre con el objetivo de mejorar la experiencia de nuestros usuarios y socios comerciales.
                        </p>
                    </div>
                    <div class="md:w-1/2">
                        <div class="relative h-full">
                            <img src="{{ asset('img/about-history.jpg') }}" alt="Nuestra historia" class="w-full h-full object-cover rounded-lg" onerror="this.src='https://via.placeholder.com/600x400?text=Nuestra+Historia'">
                            <div class="absolute bottom-4 right-4 bg-orange-500 text-white px-4 py-2 rounded-md">
                                <p class="font-bold">Desde 2015</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Línea de Tiempo -->
                <div class="mt-12">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 text-center">Nuestra Evolución</h4>
                    <div class="relative">
                        <!-- Línea central -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-orange-200"></div>
                        
                        <!-- 2015 -->
                        <div class="relative mb-12">
                            <div class="flex items-center justify-between">
                                <div class="w-5/12"></div>
                                <div class="z-10 flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full text-white font-bold">1</div>
                                <div class="w-5/12 pl-4">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h5 class="font-bold text-gray-800 mb-1">2015: El Comienzo</h5>
                                        <p class="text-gray-600">Fundación de la empresa con 5 restaurantes asociados y un equipo de 3 personas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 2017 -->
                        <div class="relative mb-12">
                            <div class="flex items-center justify-between">
                                <div class="w-5/12 pr-4 text-right">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h5 class="font-bold text-gray-800 mb-1">2017: Expansión</h5>
                                        <p class="text-gray-600">Ampliamos operaciones a 3 ciudades principales y alcanzamos los 100 restaurantes asociados.</p>
                                    </div>
                                </div>
                                <div class="z-10 flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full text-white font-bold">2</div>
                                <div class="w-5/12"></div>
                            </div>
                        </div>
                        
                        <!-- 2019 -->
                        <div class="relative mb-12">
                            <div class="flex items-center justify-between">
                                <div class="w-5/12"></div>
                                <div class="z-10 flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full text-white font-bold">3</div>
                                <div class="w-5/12 pl-4">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h5 class="font-bold text-gray-800 mb-1">2019: Innovación</h5>
                                        <p class="text-gray-600">Lanzamiento de nuestra aplicación móvil y sistema de seguimiento en tiempo real.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 2021 -->
                        <div class="relative mb-12">
                            <div class="flex items-center justify-between">
                                <div class="w-5/12 pr-4 text-right">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h5 class="font-bold text-gray-800 mb-1">2021: Crecimiento</h5>
                                        <p class="text-gray-600">Superamos los 300 restaurantes asociados y expandimos nuestro equipo a 50 colaboradores.</p>
                                    </div>
                                </div>
                                <div class="z-10 flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full text-white font-bold">4</div>
                                <div class="w-5/12"></div>
                            </div>
                        </div>
                        
                        <!-- 2023 -->
                        <div class="relative">
                            <div class="flex items-center justify-between">
                                <div class="w-5/12"></div>
                                <div class="z-10 flex items-center justify-center w-10 h-10 bg-orange-500 rounded-full text-white font-bold">5</div>
                                <div class="w-5/12 pl-4">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h5 class="font-bold text-gray-800 mb-1">2023: Actualidad</h5>
                                        <p class="text-gray-600">Presentes en 10 ciudades, con más de 500 restaurantes asociados y un equipo de 100 personas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Misión, Visión y Valores -->
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <!-- Misión -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-lg font-bold text-gray-800">Nuestra Misión</h3>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-bullseye text-orange-600 text-xl"></i>
                    </div>
                    <p class="text-gray-600 text-center">
                        Conectar a las personas con la mejor comida de su ciudad, ofreciendo un servicio de entrega rápido, confiable y de calidad, mientras apoyamos el crecimiento de los negocios locales.
                    </p>
                </div>
            </div>
            
            <!-- Visión -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-lg font-bold text-gray-800">Nuestra Visión</h3>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-eye text-orange-600 text-xl"></i>
                    </div>
                    <p class="text-gray-600 text-center">
                        Ser la plataforma líder de delivery de comida en el país, reconocida por nuestra excelencia en el servicio, innovación tecnológica y compromiso con la satisfacción de nuestros clientes, restaurantes asociados y colaboradores.
                    </p>
                </div>
            </div>
            
            <!-- Valores -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-lg font-bold text-gray-800">Nuestros Valores</h3>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-heart text-orange-600 text-xl"></i>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <span class="text-gray-600">Excelencia en el servicio</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <span class="text-gray-600">Innovación constante</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <span class="text-gray-600">Integridad y transparencia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <span class="text-gray-600">Trabajo en equipo</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <span class="text-gray-600">Compromiso con la comunidad</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Nuestro Equipo -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Nuestro Equipo Directivo</h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-4 gap-6">
                    <!-- CEO -->
                    <div class="text-center">
                        <div class="relative mb-4 mx-auto w-32 h-32 rounded-full overflow-hidden">
                            <img src="{{ asset('img/team-ceo.jpg') }}" alt="CEO" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/150?text=CEO'">
                        </div>
                        <h4 class="font-bold text-gray-800">Juan Pérez</h4>
                        <p class="text-orange-600 font-medium">CEO & Fundador</p>
                        <p class="text-gray-600 text-sm mt-2">Visionario emprendedor con más de 15 años de experiencia en tecnología y gastronomía.</p>
                    </div>
                    
                    <!-- CTO -->
                    <div class="text-center">
                        <div class="relative mb-4 mx-auto w-32 h-32 rounded-full overflow-hidden">
                            <img src="{{ asset('img/team-cto.jpg') }}" alt="CTO" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/150?text=CTO'">
                        </div>
                        <h4 class="font-bold text-gray-800">Ana Gómez</h4>
                        <p class="text-orange-600 font-medium">CTO</p>
                        <p class="text-gray-600 text-sm mt-2">Ingeniera de software con experiencia en empresas líderes del sector tecnológico.</p>
                    </div>
                    
                    <!-- COO -->
                    <div class="text-center">
                        <div class="relative mb-4 mx-auto w-32 h-32 rounded-full overflow-hidden">
                            <img src="{{ asset('img/team-coo.jpg') }}" alt="COO" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/150?text=COO'">
                        </div>
                        <h4 class="font-bold text-gray-800">Carlos Rodríguez</h4>
                        <p class="text-orange-600 font-medium">COO</p>
                        <p class="text-gray-600 text-sm mt-2">Experto en operaciones y logística con amplia experiencia en el sector de delivery.</p>
                    </div>
                    
                    <!-- CMO -->
                    <div class="text-center">
                        <div class="relative mb-4 mx-auto w-32 h-32 rounded-full overflow-hidden">
                            <img src="{{ asset('img/team-cmo.jpg') }}" alt="CMO" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/150?text=CMO'">
                        </div>
                        <h4 class="font-bold text-gray-800">Laura Martínez</h4>
                        <p class="text-orange-600 font-medium">CMO</p>
                        <p class="text-gray-600 text-sm mt-2">Especialista en marketing digital con enfoque en estrategias de crecimiento y fidelización.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Nuestros Logros -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Nuestros Logros</h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-4 gap-6 text-center">
                    <div class="p-4">
                        <div class="text-4xl font-bold text-orange-600 mb-2">500+</div>
                        <p class="text-gray-800 font-medium">Restaurantes Asociados</p>
                    </div>
                    
                    <div class="p-4">
                        <div class="text-4xl font-bold text-orange-600 mb-2">10</div>
                        <p class="text-gray-800 font-medium">Ciudades</p>
                    </div>
                    
                    <div class="p-4">
                        <div class="text-4xl font-bold text-orange-600 mb-2">100k+</div>
                        <p class="text-gray-800 font-medium">Clientes Satisfechos</p>
                    </div>
                    
                    <div class="p-4">
                        <div class="text-4xl font-bold text-orange-600 mb-2">1M+</div>
                        <p class="text-gray-800 font-medium">Pedidos Entregados</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimonios -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Lo Que Dicen Nuestros Clientes</h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Testimonio 1 -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="text-orange-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-4">"El servicio es excelente, siempre llega a tiempo y la comida en perfectas condiciones. La aplicación es muy fácil de usar y el seguimiento en tiempo real es genial."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 flex items-center justify-center">
                                <span class="text-gray-600 font-bold">MP</span>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800">María P.</h5>
                                <p class="text-gray-600 text-sm">Cliente desde 2019</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonio 2 -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="text-orange-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-4">"Como dueño de un restaurante, asociarme con Comida a Domicilio ha sido una de las mejores decisiones. Han aumentado nuestras ventas en un 30% y el sistema es muy fácil de gestionar."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 flex items-center justify-center">
                                <span class="text-gray-600 font-bold">JL</span>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800">Jorge L.</h5>
                                <p class="text-gray-600 text-sm">Restaurante asociado</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonio 3 -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="text-orange-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-4">"Trabajo como repartidor para Comida a Domicilio y puedo decir que es una empresa que realmente se preocupa por sus colaboradores. El sistema de asignación de pedidos es justo y la aplicación es muy intuitiva."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 flex items-center justify-center">
                                <span class="text-gray-600 font-bold">RS</span>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800">Roberto S.</h5>
                                <p class="text-gray-600 text-sm">Repartidor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contacto -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Contáctanos</h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Información de Contacto</h4>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-orange-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800">Dirección</h5>
                                    <p class="text-gray-600">Av. Principal 123, Ciudad</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-phone text-orange-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800">Teléfono</h5>
                                    <p class="text-gray-600">(01) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-orange-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800">Email</h5>
                                    <p class="text-gray-600">info@comidadomicilio.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-orange-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800">Horario de Atención</h5>
                                    <p class="text-gray-600">Lunes a Domingo: 9:00 - 21:00</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h5 class="font-medium text-gray-800 mb-2">Síguenos en Redes Sociales</h5>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition duration-300">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Envíanos un Mensaje</h4>
                        <form action="#" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="asunto" class="block text-sm font-medium text-gray-700 mb-1">Asunto</label>
                                <input type="text" id="asunto" name="asunto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                                <textarea id="mensaje" name="mensaje" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required></textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                                    Enviar Mensaje
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection