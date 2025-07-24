@extends('Layouts.cliente')

@section('title', 'Política de Privacidad')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Política de Privacidad</h2>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="prose max-w-none">
                    <p class="text-gray-600 mb-6">Última actualización: 15 de junio de 2023</p>
                    
                    <p class="mb-4">En Comida a Domicilio, nos comprometemos a proteger tu privacidad y a tratar tus datos personales con transparencia. Esta Política de Privacidad describe cómo recopilamos, utilizamos, compartimos y protegemos tu información cuando utilizas nuestro sitio web y servicios de entrega de comida a domicilio.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">1. Información que Recopilamos</h3>
                    <p class="mb-4">Podemos recopilar los siguientes tipos de información:</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">1.1 Información Personal</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li><strong>Información de Registro:</strong> Cuando creas una cuenta, recopilamos tu nombre, dirección de correo electrónico, número de teléfono y contraseña.</li>
                        <li><strong>Información de Perfil:</strong> Puedes proporcionar información adicional como tu foto de perfil, dirección de entrega y preferencias alimentarias.</li>
                        <li><strong>Información de Pago:</strong> Cuando realizas un pedido, recopilamos información de pago como los detalles de tu tarjeta de crédito o información de tu cuenta bancaria. Esta información es procesada por nuestros proveedores de servicios de pago y no la almacenamos directamente.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">1.2 Información de Uso</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li><strong>Información del Dispositivo:</strong> Recopilamos información sobre el dispositivo que utilizas para acceder a nuestro servicio, incluyendo el modelo de hardware, sistema operativo, identificadores únicos de dispositivo y datos de la red móvil.</li>
                        <li><strong>Información de Registro:</strong> Nuestros servidores registran automáticamente cierta información cuando utilizas nuestro servicio, incluyendo tu dirección IP, tipo de navegador, páginas visitadas, tiempo de acceso y cookies.</li>
                        <li><strong>Información de Ubicación:</strong> Con tu consentimiento, podemos recopilar y procesar información sobre tu ubicación actual para proporcionar funciones basadas en la ubicación, como la entrega a tu dirección actual.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">1.3 Información de Pedidos</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li><strong>Historial de Pedidos:</strong> Recopilamos información sobre tus pedidos, incluyendo los productos pedidos, el precio, la fecha y hora del pedido, y la dirección de entrega.</li>
                        <li><strong>Comunicaciones:</strong> Cuando te comunicas con nuestro servicio de atención al cliente, podemos recopilar y almacenar esas comunicaciones.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">2. Cómo Utilizamos tu Información</h3>
                    <p class="mb-4">Utilizamos la información que recopilamos para los siguientes propósitos:</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">2.1 Proporcionar y Mejorar Nuestros Servicios</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Procesar y entregar tus pedidos.</li>
                        <li>Gestionar tu cuenta y proporcionar atención al cliente.</li>
                        <li>Mejorar y personalizar nuestros servicios y experiencia del usuario.</li>
                        <li>Desarrollar nuevos productos, servicios y características.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">2.2 Comunicaciones</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Enviarte confirmaciones de pedidos, actualizaciones y alertas relacionadas con el servicio.</li>
                        <li>Comunicarnos contigo sobre tu cuenta o pedidos.</li>
                        <li>Enviarte información sobre promociones, ofertas especiales y nuevos servicios, si has optado por recibir dichas comunicaciones.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">2.3 Seguridad y Protección</h4>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Proteger la seguridad e integridad de nuestros servicios.</li>
                        <li>Detectar, prevenir y abordar problemas técnicos, fraudes o actividades ilegales.</li>
                        <li>Hacer cumplir nuestros términos y condiciones.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">3. Cómo Compartimos tu Información</h3>
                    <p class="mb-4">Podemos compartir tu información en las siguientes circunstancias:</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">3.1 Con Proveedores de Servicios</h4>
                    <p class="mb-4">Compartimos información con proveedores de servicios externos que realizan servicios en nuestro nombre, como procesamiento de pagos, entrega de pedidos, análisis de datos, marketing por correo electrónico, alojamiento de servicios y atención al cliente.</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">3.2 Con Restaurantes y Repartidores</h4>
                    <p class="mb-4">Compartimos la información necesaria para procesar y entregar tu pedido con los restaurantes y repartidores, incluyendo tu nombre, dirección de entrega, número de teléfono y detalles del pedido.</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">3.3 Por Razones Legales</h4>
                    <p class="mb-4">Podemos divulgar tu información si creemos de buena fe que dicha acción es necesaria para:</p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Cumplir con una obligación legal o proceso legal.</li>
                        <li>Proteger y defender nuestros derechos o propiedad.</li>
                        <li>Prevenir o investigar posibles irregularidades en relación con el Servicio.</li>
                        <li>Proteger la seguridad personal de los usuarios del Servicio o del público.</li>
                        <li>Protegernos de responsabilidad legal.</li>
                    </ul>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">3.4 Con tu Consentimiento</h4>
                    <p class="mb-4">Podemos compartir tu información con terceros cuando nos hayas dado tu consentimiento para hacerlo.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">4. Tus Derechos y Opciones</h3>
                    <p class="mb-4">Tienes ciertos derechos y opciones con respecto a tu información personal:</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">4.1 Acceso y Actualización</h4>
                    <p class="mb-4">Puedes acceder y actualizar cierta información sobre ti a través de la configuración de tu cuenta en nuestro sitio web o aplicación.</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">4.2 Comunicaciones de Marketing</h4>
                    <p class="mb-4">Puedes optar por no recibir nuestros correos electrónicos de marketing siguiendo las instrucciones de cancelación de suscripción incluidas en dichos correos electrónicos o contactándonos directamente.</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">4.3 Cookies y Tecnologías Similares</h4>
                    <p class="mb-4">La mayoría de los navegadores web están configurados para aceptar cookies por defecto. Si lo prefieres, generalmente puedes elegir configurar tu navegador para eliminar o rechazar las cookies. Ten en cuenta que si eliges eliminar o rechazar las cookies, esto podría afectar a la disponibilidad y funcionalidad de nuestros servicios.</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mt-6 mb-2">4.4 Derechos de Protección de Datos</h4>
                    <p class="mb-4">Dependiendo de tu ubicación, puedes tener ciertos derechos con respecto a tu información personal, como el derecho a:</p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Acceder a la información personal que tenemos sobre ti.</li>
                        <li>Corregir datos inexactos o incompletos.</li>
                        <li>Eliminar tu información personal.</li>
                        <li>Restringir u oponerte al procesamiento de tu información personal.</li>
                        <li>Transferir tu información a otro servicio (portabilidad de datos).</li>
                        <li>Retirar tu consentimiento en cualquier momento para el procesamiento de datos basado en el consentimiento.</li>
                    </ul>
                    <p class="mb-4">Para ejercer estos derechos, por favor contáctanos utilizando la información proporcionada al final de esta política.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">5. Seguridad de los Datos</h3>
                    <p class="mb-4">Implementamos medidas de seguridad técnicas, administrativas y físicas diseñadas para proteger la información personal que recopilamos y procesamos. Sin embargo, ningún sistema de seguridad es impenetrable y no podemos garantizar la seguridad de nuestros sistemas al 100%. En caso de que cualquier información bajo nuestro control sea comprometida como resultado de una violación de seguridad, tomaremos medidas razonables para investigar la situación y, cuando sea apropiado, notificaremos a los individuos cuya información puede haber sido comprometida y tomaremos otras medidas de acuerdo con las leyes y regulaciones aplicables.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">6. Retención de Datos</h3>
                    <p class="mb-4">Retendremos tu información personal solo durante el tiempo que sea necesario para cumplir con los propósitos para los que la recopilamos, incluyendo para satisfacer cualquier requisito legal, contable o de informes. Para determinar el período de retención apropiado para la información personal, consideramos la cantidad, naturaleza y sensibilidad de la información personal, el riesgo potencial de daño por uso o divulgación no autorizados de tu información personal, los propósitos para los cuales procesamos tu información personal y si podemos lograr esos propósitos a través de otros medios, y los requisitos legales aplicables.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">7. Transferencias Internacionales de Datos</h3>
                    <p class="mb-4">Podemos transferir, almacenar y procesar tu información en países distintos a tu país de residencia. Estos países pueden tener leyes de protección de datos diferentes a las leyes de tu país. Al proporcionarnos tu información, reconoces esta transferencia, almacenamiento o procesamiento. Tomaremos todas las medidas razonablemente necesarias para garantizar que tu información sea tratada de manera segura y de acuerdo con esta Política de Privacidad y ninguna transferencia de tu información personal se realizará a una organización o país a menos que existan controles adecuados establecidos, incluyendo la seguridad de tu información y otros datos personales.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">8. Cambios a esta Política de Privacidad</h3>
                    <p class="mb-4">Podemos actualizar nuestra Política de Privacidad de vez en cuando. Te notificaremos cualquier cambio publicando la nueva Política de Privacidad en esta página y, si los cambios son significativos, te proporcionaremos un aviso más prominente o te enviaremos una notificación por correo electrónico. Te recomendamos que revises esta Política de Privacidad periódicamente para cualquier cambio.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">9. Contacto</h3>
                    <p class="mb-4">Si tienes alguna pregunta sobre esta Política de Privacidad, por favor contáctanos a:</p>
                    <p class="mb-4">Email: privacidad@comidadomicilio.com</p>
                    <p class="mb-4">Teléfono: (01) 123-4567</p>
                    <p class="mb-4">Dirección: Av. Principal 123, Ciudad</p>
                </div>
            </div>
        </div>
        
        <!-- Preferencias de Privacidad -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">Tus Preferencias de Privacidad</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-6">Puedes personalizar tus preferencias de privacidad a continuación:</p>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Cookies Esenciales</h4>
                            <p class="text-sm text-gray-600">Necesarias para el funcionamiento básico del sitio.</p>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" id="essential-cookies" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-not-allowed" checked disabled>
                            <label for="essential-cookies" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-not-allowed"></label>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Cookies Analíticas</h4>
                            <p class="text-sm text-gray-600">Nos ayudan a entender cómo utilizas nuestro sitio.</p>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" id="analytics-cookies" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" checked>
                            <label for="analytics-cookies" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Cookies de Marketing</h4>
                            <p class="text-sm text-gray-600">Utilizadas para mostrarte anuncios relevantes.</p>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" id="marketing-cookies" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
                            <label for="marketing-cookies" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Comunicaciones de Marketing</h4>
                            <p class="text-sm text-gray-600">Recibir ofertas y promociones por email.</p>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" id="marketing-communications" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" checked>
                            <label for="marketing-communications" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <button id="save-preferences" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                        Guardar Preferencias
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .toggle-checkbox:checked {
            right: 0;
            border-color: #f97316;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #f97316;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const savePreferencesButton = document.getElementById('save-preferences');
            
            savePreferencesButton.addEventListener('click', function() {
                const analyticsEnabled = document.getElementById('analytics-cookies').checked;
                const marketingEnabled = document.getElementById('marketing-cookies').checked;
                const communicationsEnabled = document.getElementById('marketing-communications').checked;
                
                // Aquí se podría enviar esta información al servidor
                console.log('Preferencias guardadas:', {
                    analytics: analyticsEnabled,
                    marketing: marketingEnabled,
                    communications: communicationsEnabled
                });
                
                alert('Tus preferencias de privacidad han sido guardadas.');
            });
        });
    </script>
@endsection