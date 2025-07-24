@extends('Layouts.cliente')

@section('title', 'Preguntas Frecuentes')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Preguntas Frecuentes</h2>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <p class="text-gray-600 mb-8">Encuentra respuestas a las preguntas más comunes sobre nuestros servicios, pedidos, pagos y más.</p>
                
                <!-- Categorías de FAQ -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <button class="category-btn active bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium" data-category="all">Todas</button>
                    <button class="category-btn bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-full text-sm font-medium" data-category="pedidos">Pedidos</button>
                    <button class="category-btn bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-full text-sm font-medium" data-category="pagos">Pagos</button>
                    <button class="category-btn bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-full text-sm font-medium" data-category="entregas">Entregas</button>
                    <button class="category-btn bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-full text-sm font-medium" data-category="cuenta">Mi Cuenta</button>
                </div>
                
                <!-- Buscador de FAQ -->
                <div class="mb-8">
                    <div class="relative">
                        <input type="text" id="faq-search" placeholder="Buscar pregunta..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Acordeón de preguntas -->
                <div class="space-y-4" id="faq-container">
                    <!-- Pedidos -->
                    <div class="faq-item" data-category="pedidos">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cómo puedo realizar un pedido?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Realizar un pedido es muy sencillo. Sigue estos pasos:
                            </p>
                            <ol class="list-decimal list-inside mt-2 space-y-2 text-gray-600">
                                <li>Inicia sesión en tu cuenta</li>
                                <li>Navega por nuestro menú y selecciona los productos que deseas</li>
                                <li>Haz clic en "Agregar al carrito" para cada producto</li>
                                <li>Ve a tu carrito haciendo clic en el ícono de carrito en la parte superior</li>
                                <li>Revisa tu pedido y haz clic en "Realizar pedido"</li>
                                <li>Selecciona la dirección de entrega y el método de pago</li>
                                <li>Confirma tu pedido</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="pedidos">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Puedo modificar o cancelar mi pedido?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Puedes cancelar tu pedido siempre y cuando esté en estado "Pendiente". Una vez que el pedido cambia a "En proceso", ya no es posible cancelarlo directamente desde la plataforma.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Para cancelar un pedido pendiente, ve a la sección "Mis Pedidos", busca el pedido que deseas cancelar y haz clic en el botón "Cancelar".
                            </p>
                            <p class="text-gray-600 mt-2">
                                Si necesitas modificar un pedido que ya está en proceso, te recomendamos contactar directamente con nuestro servicio de atención al cliente lo antes posible.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="pedidos">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cómo puedo ver el estado de mi pedido?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Puedes seguir el estado de tu pedido en tiempo real siguiendo estos pasos:
                            </p>
                            <ol class="list-decimal list-inside mt-2 space-y-2 text-gray-600">
                                <li>Inicia sesión en tu cuenta</li>
                                <li>Ve a la sección "Mis Pedidos" en el menú principal</li>
                                <li>Busca el pedido que deseas consultar</li>
                                <li>Haz clic en "Ver detalles" para obtener información detallada sobre el estado actual</li>
                            </ol>
                            <p class="text-gray-600 mt-2">
                                También recibirás notificaciones por correo electrónico y en la plataforma cuando el estado de tu pedido cambie.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Pagos -->
                    <div class="faq-item" data-category="pagos">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Qué métodos de pago aceptan?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Aceptamos los siguientes métodos de pago:
                            </p>
                            <ul class="list-disc list-inside mt-2 space-y-2 text-gray-600">
                                <li>Efectivo (pago contra entrega)</li>
                                <li>Tarjetas de crédito y débito (Visa, Mastercard, American Express)</li>
                                <li>Transferencia bancaria</li>
                                <li>Yape</li>
                                <li>Plin</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                Puedes seleccionar tu método de pago preferido durante el proceso de checkout.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="pagos">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Es seguro pagar en línea?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Sí, todas nuestras transacciones en línea están protegidas con tecnología de encriptación SSL de 256 bits, lo que garantiza que tu información de pago esté segura. No almacenamos los datos completos de tu tarjeta en nuestros servidores.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Además, trabajamos con pasarelas de pago reconocidas y confiables que cumplen con los estándares de seguridad PCI DSS.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Si prefieres no pagar en línea, siempre puedes optar por el pago contra entrega.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Entregas -->
                    <div class="faq-item" data-category="entregas">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cuál es el tiempo estimado de entrega?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                El tiempo estimado de entrega es de 30 a 45 minutos, dependiendo de la distancia y las condiciones del tráfico. Durante horas pico o condiciones climáticas adversas, el tiempo de entrega podría extenderse.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Una vez que realices tu pedido, te proporcionaremos un tiempo estimado de entrega más preciso. También puedes seguir el estado de tu pedido en tiempo real a través de nuestra plataforma.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="entregas">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cuál es el costo de envío?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                El costo de envío se calcula automáticamente en función de la distancia entre nuestro restaurante y tu dirección de entrega. El costo base es de S/. 5.00 para distancias menores a 3 km.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Para pedidos superiores a S/. 50.00, el envío es gratuito dentro de un radio de 5 km.
                            </p>
                            <p class="text-gray-600 mt-2">
                                El costo exacto de envío se mostrará durante el proceso de checkout antes de confirmar tu pedido.
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="entregas">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Puedo programar una entrega para más tarde?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Sí, ofrecemos la opción de programar entregas con anticipación. Durante el proceso de checkout, puedes seleccionar la fecha y hora en la que deseas recibir tu pedido.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Las entregas programadas están disponibles con un mínimo de 2 horas de anticipación y hasta con 7 días de antelación.
                            </p>
                            <p class="text-gray-600 mt-2">
                                Ten en cuenta que para pedidos programados, el pago debe realizarse por adelantado.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Mi Cuenta -->
                    <div class="faq-item" data-category="cuenta">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cómo puedo actualizar mi información personal?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Para actualizar tu información personal, sigue estos pasos:
                            </p>
                            <ol class="list-decimal list-inside mt-2 space-y-2 text-gray-600">
                                <li>Inicia sesión en tu cuenta</li>
                                <li>Haz clic en tu nombre o foto de perfil en la esquina superior derecha</li>
                                <li>Selecciona "Mi Perfil" en el menú desplegable</li>
                                <li>Actualiza la información que desees cambiar</li>
                                <li>Haz clic en "Guardar Cambios"</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="cuenta">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cómo puedo gestionar mis direcciones de entrega?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Para gestionar tus direcciones de entrega, sigue estos pasos:
                            </p>
                            <ol class="list-decimal list-inside mt-2 space-y-2 text-gray-600">
                                <li>Inicia sesión en tu cuenta</li>
                                <li>Haz clic en tu nombre o foto de perfil en la esquina superior derecha</li>
                                <li>Selecciona "Mis Direcciones" en el menú desplegable</li>
                                <li>Aquí puedes ver, agregar, editar o eliminar tus direcciones</li>
                                <li>También puedes establecer una dirección como predeterminada</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="faq-item" data-category="cuenta">
                        <button class="faq-question w-full flex justify-between items-center text-left p-4 rounded-lg bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <span class="font-medium text-gray-800">¿Cómo puedo cambiar mi contraseña?</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 bg-white">
                            <p class="text-gray-600">
                                Para cambiar tu contraseña, sigue estos pasos:
                            </p>
                            <ol class="list-decimal list-inside mt-2 space-y-2 text-gray-600">
                                <li>Inicia sesión en tu cuenta</li>
                                <li>Haz clic en tu nombre o foto de perfil en la esquina superior derecha</li>
                                <li>Selecciona "Mi Perfil" en el menú desplegable</li>
                                <li>Desplázate hacia abajo hasta la sección "Cambiar Contraseña"</li>
                                <li>Ingresa tu contraseña actual y la nueva contraseña</li>
                                <li>Haz clic en "Guardar Cambios"</li>
                            </ol>
                            <p class="text-gray-600 mt-2">
                                Si olvidaste tu contraseña, puedes usar la opción "¿Olvidaste tu contraseña?" en la página de inicio de sesión para restablecerla.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Mensaje cuando no hay resultados en la búsqueda -->
                <div id="no-results" class="hidden text-center py-8">
                    <p class="text-gray-600">No se encontraron preguntas que coincidan con tu búsqueda.</p>
                    <p class="text-gray-600 mt-2">Intenta con otros términos o <a href="#" class="text-orange-600 hover:text-orange-800">contáctanos</a> directamente.</p>
                </div>
            </div>
        </div>
        
        <!-- Sección de contacto -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">¿No encontraste lo que buscabas?</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Si tienes alguna pregunta que no ha sido respondida, no dudes en contactarnos. Estamos aquí para ayudarte.</p>
                
                <div class="grid md:grid-cols-3 gap-6 mt-6">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-phone text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-1">Teléfono</h4>
                        <p class="text-gray-600">(01) 123-4567</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-envelope text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-1">Email</h4>
                        <p class="text-gray-600">soporte@comidadomicilio.com</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-comments text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-1">Chat en vivo</h4>
                        <p class="text-gray-600">Disponible de 9:00 a 21:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejo de categorías
            const categoryButtons = document.querySelectorAll('.category-btn');
            const faqItems = document.querySelectorAll('.faq-item');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remover clase activa de todos los botones
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-orange-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    
                    // Agregar clase activa al botón clickeado
                    this.classList.add('active', 'bg-orange-500', 'text-white');
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    
                    const category = this.getAttribute('data-category');
                    
                    // Mostrar/ocultar preguntas según la categoría
                    faqItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                    
                    // Verificar si hay resultados visibles
                    checkVisibleResults();
                });
            });
            
            // Manejo de acordeón
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    
                    // Toggle respuesta
                    answer.classList.toggle('hidden');
                    
                    // Rotar icono
                    if (answer.classList.contains('hidden')) {
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
            
            // Búsqueda
            const searchInput = document.getElementById('faq-search');
            const noResults = document.getElementById('no-results');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let visibleCount = 0;
                
                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    // Verificar si la pregunta o respuesta contiene el término de búsqueda
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        // Solo mostrar si también cumple con el filtro de categoría
                        const activeCategory = document.querySelector('.category-btn.active').getAttribute('data-category');
                        if (activeCategory === 'all' || item.getAttribute('data-category') === activeCategory) {
                            item.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            item.classList.add('hidden');
                        }
                    } else {
                        item.classList.add('hidden');
                    }
                });
                
                // Mostrar mensaje si no hay resultados
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            });
            
            function checkVisibleResults() {
                const visibleItems = document.querySelectorAll('.faq-item:not(.hidden)');
                if (visibleItems.length === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }
        });
    </script>
@endsection