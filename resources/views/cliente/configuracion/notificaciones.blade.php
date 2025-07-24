@extends('Layouts.cliente')

@section('title', 'Configuración de Notificaciones')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Configuración de Notificaciones</h2>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <form action="{{ route('cliente.configuracion.notificaciones.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Notificaciones por Correo Electrónico</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Confirmación de Pedido</p>
                                        <p class="text-sm text-gray-500">Recibe un correo cuando tu pedido sea confirmado</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="email_confirmacion" value="1" class="sr-only peer" {{ $config->email_confirmacion ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Actualización de Estado</p>
                                        <p class="text-sm text-gray-500">Recibe un correo cuando el estado de tu pedido cambie</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="email_actualizacion" value="1" class="sr-only peer" {{ $config->email_actualizacion ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Entrega Completada</p>
                                        <p class="text-sm text-gray-500">Recibe un correo cuando tu pedido haya sido entregado</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="email_entrega" value="1" class="sr-only peer" {{ $config->email_entrega ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Promociones y Ofertas</p>
                                        <p class="text-sm text-gray-500">Recibe correos sobre promociones y ofertas especiales</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="email_promociones" value="1" class="sr-only peer" {{ $config->email_promociones ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Notificaciones en la Aplicación</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Confirmación de Pedido</p>
                                        <p class="text-sm text-gray-500">Recibe una notificación cuando tu pedido sea confirmado</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="app_confirmacion" value="1" class="sr-only peer" {{ $config->app_confirmacion ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Actualización de Estado</p>
                                        <p class="text-sm text-gray-500">Recibe una notificación cuando el estado de tu pedido cambie</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="app_actualizacion" value="1" class="sr-only peer" {{ $config->app_actualizacion ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Entrega Próxima</p>
                                        <p class="text-sm text-gray-500">Recibe una notificación cuando tu pedido esté en camino</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="app_entrega_proxima" value="1" class="sr-only peer" {{ $config->app_entrega_proxima ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Entrega Completada</p>
                                        <p class="text-sm text-gray-500">Recibe una notificación cuando tu pedido haya sido entregado</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="app_entrega" value="1" class="sr-only peer" {{ $config->app_entrega ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Promociones y Ofertas</p>
                                        <p class="text-sm text-gray-500">Recibe notificaciones sobre promociones y ofertas especiales</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="app_promociones" value="1" class="sr-only peer" {{ $config->app_promociones ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Notificaciones por SMS</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Confirmación de Pedido</p>
                                        <p class="text-sm text-gray-500">Recibe un SMS cuando tu pedido sea confirmado</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="sms_confirmacion" value="1" class="sr-only peer" {{ $config->sms_confirmacion ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Entrega Próxima</p>
                                        <p class="text-sm text-gray-500">Recibe un SMS cuando tu pedido esté en camino</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="sms_entrega_proxima" value="1" class="sr-only peer" {{ $config->sms_entrega_proxima ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="telefono_notificaciones" class="block text-sm font-medium text-gray-700 mb-1">Teléfono para notificaciones SMS</label>
                                <input type="text" name="telefono_notificaciones" id="telefono_notificaciones" value="{{ old('telefono_notificaciones', $config->telefono_notificaciones) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                <p class="text-xs text-gray-500 mt-1">Asegúrate de incluir el código de país (Ej: +51 999999999)</p>
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
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Eliminar Todas las Notificaciones</h3>
                    <p class="text-gray-600 mb-4">Esta acción eliminará todas tus notificaciones actuales. Esta acción no se puede deshacer.</p>
                    
                    <form action="{{ route('cliente.notificaciones.eliminar-todas') }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar todas tus notificaciones?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                            Eliminar Todas las Notificaciones
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection