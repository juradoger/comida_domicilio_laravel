@extends('Layouts.cliente')

@section('title', 'Soporte al Cliente')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Soporte al Cliente</h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <!-- Tarjeta de Contacto Telefónico -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-phone text-orange-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Llámanos</h3>
                    <p class="text-gray-600 mb-4">Disponible de lunes a domingo de 9:00 a 21:00 horas.</p>
                    <p class="text-lg font-medium text-gray-800">(01) 123-4567</p>
                </div>
            </div>
            
            <!-- Tarjeta de Email -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-envelope text-orange-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Escríbenos</h3>
                    <p class="text-gray-600 mb-4">Te responderemos en un plazo máximo de 24 horas.</p>
                    <p class="text-lg font-medium text-gray-800">soporte@comidadomicilio.com</p>
                </div>
            </div>
            
            <!-- Tarjeta de Chat en Vivo -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-comments text-orange-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Chat en Vivo</h3>
                    <p class="text-gray-600 mb-4">Habla con un agente en tiempo real.</p>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                        Iniciar Chat
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Formulario de Contacto -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Envíanos un Mensaje</h3>
            </div>
            <div class="p-6">
                <form action="#" method="POST" id="contactForm">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="asunto" class="block text-sm font-medium text-gray-700 mb-1">Asunto</label>
                        <input type="text" id="asunto" name="asunto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                    </div>
                    
                    <div class="mb-6">
                        <label for="tipo_consulta" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Consulta</label>
                        <select id="tipo_consulta" name="tipo_consulta" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="pedido">Consulta sobre un pedido</option>
                            <option value="producto">Consulta sobre un producto</option>
                            <option value="pago">Problema con un pago</option>
                            <option value="entrega">Problema con una entrega</option>
                            <option value="cuenta">Problema con mi cuenta</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    
                    <div id="pedido_container" class="mb-6 hidden">
                        <label for="pedido_id" class="block text-sm font-medium text-gray-700 mb-1">Número de Pedido</label>
                        <input type="text" id="pedido_id" name="pedido_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>
                    
                    <div class="mb-6">
                        <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label for="archivos" class="block text-sm font-medium text-gray-700 mb-1">Adjuntar Archivos (opcional)</label>
                        <input type="file" id="archivos" name="archivos[]" class="w-full text-gray-700 py-2" multiple>
                        <p class="text-xs text-gray-500 mt-1">Puedes adjuntar hasta 3 archivos (máx. 5MB cada uno). Formatos permitidos: JPG, PNG, PDF.</p>
                    </div>
                    
                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terminos" name="terminos" class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200" required>
                        <label for="terminos" class="ml-2 block text-sm text-gray-700">
                            Acepto la <a href="#" class="text-orange-600 hover:text-orange-800">Política de Privacidad</a> y el tratamiento de mis datos personales.
                        </label>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Preguntas Frecuentes -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Preguntas Frecuentes</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Consulta nuestra sección de preguntas frecuentes para encontrar respuestas rápidas a las consultas más comunes.</p>
                
                <div class="space-y-4">
                    <div class="border-b pb-4">
                        <h4 class="font-medium text-gray-800 mb-2">¿Cómo puedo rastrear mi pedido?</h4>
                        <p class="text-gray-600">Puedes rastrear tu pedido iniciando sesión en tu cuenta y visitando la sección "Mis Pedidos". Allí encontrarás información detallada sobre el estado actual de tu pedido.</p>
                    </div>
                    
                    <div class="border-b pb-4">
                        <h4 class="font-medium text-gray-800 mb-2">¿Qué hago si mi pedido llega incompleto?</h4>
                        <p class="text-gray-600">Si tu pedido llega incompleto, por favor contáctanos inmediatamente a través de cualquiera de nuestros canales de atención. Te ayudaremos a resolver el problema lo antes posible.</p>
                    </div>
                    
                    <div class="border-b pb-4">
                        <h4 class="font-medium text-gray-800 mb-2">¿Cómo puedo solicitar un reembolso?</h4>
                        <p class="text-gray-600">Para solicitar un reembolso, debes contactarnos dentro de las 24 horas siguientes a la recepción de tu pedido. Evaluaremos tu caso y procederemos según corresponda.</p>
                    </div>
                </div>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('cliente.faq.index') }}" class="inline-flex items-center text-orange-600 hover:text-orange-800">
                        Ver todas las preguntas frecuentes
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoConsulta = document.getElementById('tipo_consulta');
            const pedidoContainer = document.getElementById('pedido_container');
            
            tipoConsulta.addEventListener('change', function() {
                if (this.value === 'pedido' || this.value === 'entrega' || this.value === 'pago') {
                    pedidoContainer.classList.remove('hidden');
                } else {
                    pedidoContainer.classList.add('hidden');
                }
            });
            
            // Manejo del formulario
            const contactForm = document.getElementById('contactForm');
            
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Aquí iría la lógica para enviar el formulario
                // Por ahora, solo mostraremos un mensaje de éxito
                
                alert('Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo lo antes posible.');
                contactForm.reset();
            });
        });
    </script>
@endsection