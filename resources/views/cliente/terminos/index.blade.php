@extends('Layouts.cliente')

@section('title', 'Términos y Condiciones')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Términos y Condiciones</h2>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <div class="prose max-w-none">
                    <p class="text-gray-600 mb-6">Última actualización: 15 de junio de 2023</p>
                    
                    <p class="mb-4">Por favor, lee detenidamente estos términos y condiciones antes de utilizar nuestros servicios. Al acceder o utilizar nuestro sitio web y servicios de entrega de comida a domicilio, aceptas estar legalmente obligado por estos términos y condiciones.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">1. Definiciones</h3>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li><strong>"Servicio"</strong> se refiere a la plataforma de pedidos de comida a domicilio operada por Comida a Domicilio.</li>
                        <li><strong>"Usuario"</strong> se refiere a cualquier persona que acceda o utilice el Servicio.</li>
                        <li><strong>"Cliente"</strong> se refiere a cualquier Usuario que realice un pedido a través del Servicio.</li>
                        <li><strong>"Cuenta"</strong> se refiere a la cuenta registrada de un Usuario en el Servicio.</li>
                        <li><strong>"Contenido"</strong> se refiere a toda la información y datos disponibles en el Servicio, incluyendo pero no limitado a texto, imágenes, videos, gráficos, y cualquier otro material.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">2. Registro de Cuenta</h3>
                    <p class="mb-4">Para utilizar ciertos aspectos del Servicio, debes registrarte y crear una cuenta. Al registrarte, aceptas proporcionar información precisa, actual y completa. Eres responsable de mantener la confidencialidad de tu contraseña y de todas las actividades que ocurran bajo tu cuenta.</p>
                    <p class="mb-4">Nos reservamos el derecho de suspender o terminar tu cuenta si alguna información proporcionada durante el proceso de registro o después resulta ser inexacta, falsa o incompleta.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">3. Pedidos y Pagos</h3>
                    <p class="mb-4">Al realizar un pedido a través de nuestro Servicio, aceptas pagar el precio total del pedido, incluyendo el costo de los productos, los impuestos aplicables, las tarifas de entrega y cualquier otro cargo adicional que pueda aplicarse.</p>
                    <p class="mb-4">Nos reservamos el derecho de rechazar o cancelar cualquier pedido por cualquier motivo, incluyendo pero no limitado a la indisponibilidad de productos, errores en la descripción o precio de los productos, o sospecha de fraude.</p>
                    <p class="mb-4">Los métodos de pago aceptados se mostrarán durante el proceso de pago. Al proporcionar la información de pago, garantizas que estás autorizado a utilizar el método de pago seleccionado.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">4. Entrega</h3>
                    <p class="mb-4">Los tiempos de entrega son estimados y pueden variar debido a factores como el tráfico, las condiciones climáticas, la disponibilidad de repartidores y otros factores fuera de nuestro control.</p>
                    <p class="mb-4">Es responsabilidad del Cliente proporcionar una dirección de entrega precisa y completa. No nos hacemos responsables de los retrasos o imposibilidad de entrega debido a información incorrecta o incompleta proporcionada por el Cliente.</p>
                    <p class="mb-4">El Cliente debe estar disponible para recibir el pedido en la dirección proporcionada. Si el Cliente no está disponible después de un tiempo razonable de espera, el repartidor puede dejar el pedido en un lugar seguro o llevárselo, según lo considere apropiado.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">5. Cancelaciones y Reembolsos</h3>
                    <p class="mb-4">Los pedidos pueden ser cancelados sin cargo antes de que sean aceptados por el restaurante. Una vez que el pedido ha sido aceptado, la cancelación puede estar sujeta a cargos.</p>
                    <p class="mb-4">Los reembolsos pueden ser otorgados a nuestra discreción en casos de:</p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Pedidos no entregados debido a errores de nuestro Servicio o repartidores.</li>
                        <li>Productos que no cumplen con los estándares de calidad razonables.</li>
                        <li>Pedidos incompletos o incorrectos.</li>
                    </ul>
                    <p class="mb-4">Las solicitudes de reembolso deben ser presentadas dentro de las 24 horas siguientes a la entrega del pedido.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">6. Propiedad Intelectual</h3>
                    <p class="mb-4">Todo el Contenido disponible a través del Servicio, incluyendo pero no limitado a logotipos, marcas comerciales, textos, gráficos, fotografías, videos, y software, está protegido por derechos de autor, marcas comerciales y otras leyes de propiedad intelectual.</p>
                    <p class="mb-4">No se otorga ningún derecho o licencia sobre dicho Contenido, excepto el derecho limitado de utilizar el Servicio de acuerdo con estos Términos y Condiciones.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">7. Conducta del Usuario</h3>
                    <p class="mb-4">Al utilizar nuestro Servicio, aceptas no:</p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Utilizar el Servicio de manera fraudulenta o para cualquier propósito ilegal.</li>
                        <li>Acosar, amenazar, intimidar o causar malestar a nuestros empleados, repartidores o a otros Usuarios.</li>
                        <li>Proporcionar información falsa o engañosa.</li>
                        <li>Intentar acceder a cuentas de otros Usuarios o a áreas restringidas del Servicio.</li>
                        <li>Interferir con el funcionamiento normal del Servicio.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">8. Limitación de Responsabilidad</h3>
                    <p class="mb-4">En la medida permitida por la ley, no seremos responsables por daños indirectos, incidentales, especiales, consecuentes o punitivos, o por cualquier pérdida de beneficios o ingresos, ya sea incurrida directa o indirectamente, o cualquier pérdida de datos, uso, buena voluntad, u otras pérdidas intangibles, resultantes de:</p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Tu uso o incapacidad para usar el Servicio.</li>
                        <li>Cualquier transacción o relación entre tú y cualquier tercero, incluso si hemos sido advertidos de la posibilidad de tales daños.</li>
                        <li>Acceso no autorizado, uso o alteración de tus transmisiones o contenido.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">9. Indemnización</h3>
                    <p class="mb-4">Aceptas indemnizar, defender y mantener indemne a Comida a Domicilio y a sus afiliados, oficiales, empleados, agentes y socios, de y contra cualquier reclamo, disputa, demanda, responsabilidad, daño, pérdida, y gasto, incluyendo, sin limitación, honorarios legales razonables, que surjan de o estén relacionados de alguna manera con tu acceso o uso del Servicio, tu Contenido, o tu violación de estos Términos y Condiciones.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">10. Modificaciones</h3>
                    <p class="mb-4">Nos reservamos el derecho, a nuestra sola discreción, de modificar o reemplazar estos Términos y Condiciones en cualquier momento. Si una revisión es material, haremos esfuerzos razonables para proporcionar al menos 30 días de aviso antes de que los nuevos términos entren en vigencia.</p>
                    <p class="mb-4">Al continuar accediendo o utilizando nuestro Servicio después de que esas revisiones entren en vigencia, aceptas estar obligado por los términos revisados. Si no estás de acuerdo con los nuevos términos, por favor deja de usar el Servicio.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">11. Ley Aplicable</h3>
                    <p class="mb-4">Estos Términos y Condiciones se regirán e interpretarán de acuerdo con las leyes del país, sin tener en cuenta sus disposiciones sobre conflictos de leyes.</p>
                    <p class="mb-4">Cualquier disputa, controversia o reclamo que surja de o esté relacionado con estos Términos y Condiciones, o el incumplimiento, terminación o invalidez de los mismos, será resuelta por los tribunales competentes de la jurisdicción correspondiente.</p>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">12. Contacto</h3>
                    <p class="mb-4">Si tienes alguna pregunta sobre estos Términos y Condiciones, por favor contáctanos a:</p>
                    <p class="mb-4">Email: legal@comidadomicilio.com</p>
                    <p class="mb-4">Teléfono: (01) 123-4567</p>
                    <p class="mb-4">Dirección: Av. Principal 123, Ciudad</p>
                </div>
            </div>
        </div>
        
        <!-- Aceptación de Términos -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="accept-terms" class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    <label for="accept-terms" class="ml-2 block text-sm text-gray-700">
                        He leído y acepto los Términos y Condiciones y la Política de Privacidad.
                    </label>
                </div>
                
                <div class="flex justify-end">
                    <button id="confirm-button" class="bg-gray-300 text-gray-500 font-medium py-2 px-6 rounded-md cursor-not-allowed" disabled>
                        Confirmar Aceptación
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const acceptTermsCheckbox = document.getElementById('accept-terms');
            const confirmButton = document.getElementById('confirm-button');
            
            acceptTermsCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    confirmButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    confirmButton.classList.add('bg-orange-500', 'hover:bg-orange-600', 'text-white', 'transition', 'duration-300');
                    confirmButton.disabled = false;
                } else {
                    confirmButton.classList.remove('bg-orange-500', 'hover:bg-orange-600', 'text-white', 'transition', 'duration-300');
                    confirmButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    confirmButton.disabled = true;
                }
            });
            
            confirmButton.addEventListener('click', function() {
                if (!this.disabled) {
                    alert('Has aceptado los Términos y Condiciones. Gracias por confiar en nosotros.');
                    // Aquí se podría redirigir al usuario o realizar alguna acción adicional
                }
            });
        });
    </script>
@endsection