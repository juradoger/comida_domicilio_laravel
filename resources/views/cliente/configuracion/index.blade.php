@extends('Layouts.cliente')

@section('title', 'Configuración de Cuenta')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Configuración de Cuenta</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Perfil -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Mi Perfil</h3>
                        <p class="text-gray-600 text-center mb-6">Actualiza tu información personal, foto de perfil y datos de contacto.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.perfil.index') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Administrar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Direcciones -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Mis Direcciones</h3>
                        <p class="text-gray-600 text-center mb-6">Administra tus direcciones de entrega y establece una dirección predeterminada.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.perfil.direcciones') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Administrar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Métodos de Pago -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Métodos de Pago</h3>
                        <p class="text-gray-600 text-center mb-6">Administra tus tarjetas y otros métodos de pago para tus pedidos.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.pagos.metodos') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Administrar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Notificaciones -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Notificaciones</h3>
                        <p class="text-gray-600 text-center mb-6">Configura cómo y cuándo quieres recibir notificaciones sobre tus pedidos.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.configuracion.notificaciones') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Configurar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Privacidad -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Privacidad</h3>
                        <p class="text-gray-600 text-center mb-6">Administra tus preferencias de privacidad y el uso de tus datos personales.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.configuracion.privacidad') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Configurar
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Preferencias -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-3 bg-gradient-to-r from-orange-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-500 rounded-full mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Preferencias</h3>
                        <p class="text-gray-600 text-center mb-6">Personaliza tu experiencia, idioma, moneda y otras preferencias.</p>
                        <div class="flex justify-center">
                            <a href="{{ route('cliente.configuracion.preferencias') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                                Configurar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-10">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Seguridad de la Cuenta</h3>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h4 class="text-lg font-semibold text-gray-800">Cambiar Contraseña</h4>
                                <p class="text-gray-600">Actualiza tu contraseña para mantener tu cuenta segura</p>
                            </div>
                            <a href="{{ route('cliente.perfil.index') }}#cambiar-password" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 text-center">
                                Cambiar Contraseña
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-4">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h4 class="text-lg font-semibold text-gray-800">Sesiones Activas</h4>
                                <p class="text-gray-600">Administra los dispositivos donde has iniciado sesión</p>
                            </div>
                            <a href="{{ route('cliente.configuracion.sesiones') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 text-center">
                                Ver Sesiones
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection