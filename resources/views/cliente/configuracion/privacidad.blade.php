@extends('Layouts.cliente')

@section('title', 'Configuración de Privacidad')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Configuración de Privacidad</h2>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <form action="{{ route('cliente.configuracion.privacidad.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Visibilidad de Perfil</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Mostrar mi foto de perfil</p>
                                        <p class="text-sm text-gray-500">Tu foto de perfil será visible para restaurantes y repartidores</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="mostrar_foto" value="1" class="sr-only peer" {{ $config->mostrar_foto ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Mostrar mi nombre completo</p>
                                        <p class="text-sm text-gray-500">Tu nombre completo será visible para restaurantes y repartidores</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="mostrar_nombre" value="1" class="sr-only peer" {{ $config->mostrar_nombre ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Mostrar mi historial de pedidos</p>
                                        <p class="text-sm text-gray-500">Los restaurantes podrán ver tus pedidos anteriores</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="mostrar_historial" value="1" class="sr-only peer" {{ $config->mostrar_historial ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Compartir Datos</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Compartir datos para mejorar el servicio</p>
                                        <p class="text-sm text-gray-500">Permitir que usemos tus datos para mejorar nuestros servicios</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="compartir_mejoras" value="1" class="sr-only peer" {{ $config->compartir_mejoras ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Compartir datos para marketing</p>
                                        <p class="text-sm text-gray-500">Permitir que usemos tus datos para enviarte ofertas personalizadas</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="compartir_marketing" value="1" class="sr-only peer" {{ $config->compartir_marketing ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Compartir datos con restaurantes asociados</p>
                                        <p class="text-sm text-gray-500">Permitir que los restaurantes usen tus datos para mejorar su servicio</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="compartir_restaurantes" value="1" class="sr-only peer" {{ $config->compartir_restaurantes ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ubicación</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Permitir acceso a ubicación en segundo plano</p>
                                        <p class="text-sm text-gray-500">Permite que accedamos a tu ubicación incluso cuando no estés usando la app</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="ubicacion_segundo_plano" value="1" class="sr-only peer" {{ $config->ubicacion_segundo_plano ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Guardar historial de ubicaciones</p>
                                        <p class="text-sm text-gray-500">Permite que guardemos tu historial de ubicaciones para mejorar el servicio</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="guardar_ubicaciones" value="1" class="sr-only peer" {{ $config->guardar_ubicaciones ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                                Guardar Preferencias
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Descargar Mis Datos</h3>
                    <p class="text-gray-600 mb-4">Puedes solicitar una copia de todos tus datos personales que tenemos almacenados. El archivo será enviado a tu correo electrónico.</p>
                    
                    <form action="{{ route('cliente.datos.descargar') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                            Solicitar Mis Datos
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-red-600 mb-4">Eliminar Mi Cuenta</h3>
                    <p class="text-gray-600 mb-4">Esta acción eliminará permanentemente tu cuenta y todos tus datos. Esta acción no se puede deshacer.</p>
                    
                    <button type="button" onclick="document.getElementById('modal-eliminar-cuenta').classList.remove('hidden')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                        Eliminar Mi Cuenta
                    </button>
                    
                    <!-- Modal de confirmación -->
                    <div id="modal-eliminar-cuenta" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
                        <div class="bg-white rounded-lg max-w-md w-full p-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-4">Confirmar eliminación de cuenta</h4>
                            <p class="text-gray-600 mb-6">Esta acción eliminará permanentemente tu cuenta y todos tus datos. Por favor, confirma tu contraseña para continuar.</p>
                            
                            <form action="{{ route('cliente.cuenta.eliminar') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                                    <input type="password" name="password" id="password" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="document.getElementById('modal-eliminar-cuenta').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md transition duration-300">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                        Eliminar Cuenta
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection