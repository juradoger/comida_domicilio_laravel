@extends('Layouts.cliente')

@section('title', 'Preferencias')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Preferencias</h2>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <form action="{{ route('cliente.configuracion.preferencias.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Preferencias Generales</h3>

                            <div class="mb-4">
                                <label for="idioma" class="block text-sm font-medium text-gray-700 mb-1">Idioma</label>
                                <select id="idioma" name="idioma"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="es" {{ $preferencias->idioma == 'es' ? 'selected' : '' }}>Español
                                    </option>
                                    <option value="en" {{ $preferencias->idioma == 'en' ? 'selected' : '' }}>English
                                    </option>
                                    <option value="pt" {{ $preferencias->idioma == 'pt' ? 'selected' : '' }}>Português
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="moneda" class="block text-sm font-medium text-gray-700 mb-1">Moneda</label>
                                <select id="moneda" name="moneda"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="PEN" {{ $preferencias->moneda == 'PEN' ? 'selected' : '' }}>Soles (Bs)
                                    </option>
                                    <option value="USD" {{ $preferencias->moneda == 'USD' ? 'selected' : '' }}>Dólares
                                        ($)</option>
                                    <option value="EUR" {{ $preferencias->moneda == 'EUR' ? 'selected' : '' }}>Euros (€)
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="zona_horaria" class="block text-sm font-medium text-gray-700 mb-1">Zona
                                    Horaria</label>
                                <select id="zona_horaria" name="zona_horaria"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="America/Lima"
                                        {{ $preferencias->zona_horaria == 'America/Lima' ? 'selected' : '' }}>Lima (GMT-5)
                                    </option>
                                    <option value="America/Bogota"
                                        {{ $preferencias->zona_horaria == 'America/Bogota' ? 'selected' : '' }}>Bogotá
                                        (GMT-5)</option>
                                    <option value="America/Santiago"
                                        {{ $preferencias->zona_horaria == 'America/Santiago' ? 'selected' : '' }}>Santiago
                                        (GMT-4)</option>
                                    <option value="America/Buenos_Aires"
                                        {{ $preferencias->zona_horaria == 'America/Buenos_Aires' ? 'selected' : '' }}>
                                        Buenos Aires (GMT-3)</option>
                                    <option value="America/Mexico_City"
                                        {{ $preferencias->zona_horaria == 'America/Mexico_City' ? 'selected' : '' }}>Ciudad
                                        de México (GMT-6)</option>
                                    <option value="Europe/Madrid"
                                        {{ $preferencias->zona_horaria == 'Europe/Madrid' ? 'selected' : '' }}>Madrid
                                        (GMT+1)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Preferencias de Pedidos</h3>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Recordatorios de pedidos pendientes</p>
                                        <p class="text-sm text-gray-500">Recibe recordatorios sobre pedidos que has dejado
                                            en el carrito</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="recordatorio_pedidos" value="1"
                                            class="sr-only peer"
                                            {{ $preferencias->recordatorio_pedidos ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Sugerencias basadas en pedidos anteriores</p>
                                        <p class="text-sm text-gray-500">Recibe sugerencias de productos basadas en tus
                                            pedidos anteriores</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="sugerencias_pedidos" value="1"
                                            class="sr-only peer" {{ $preferencias->sugerencias_pedidos ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-700">Guardar historial de búsqueda</p>
                                        <p class="text-sm text-gray-500">Guarda tu historial de búsqueda para mejorar las
                                            recomendaciones</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="guardar_busquedas" value="1" class="sr-only peer"
                                            {{ $preferencias->guardar_busquedas ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="metodo_pago_preferido"
                                    class="block text-sm font-medium text-gray-700 mb-1">Método de pago preferido</label>
                                <select id="metodo_pago_preferido" name="metodo_pago_preferido"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value=""
                                        {{ $preferencias->metodo_pago_preferido == '' ? 'selected' : '' }}>Seleccionar al
                                        momento de pagar</option>
                                    @foreach ($metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}"
                                            {{ $preferencias->metodo_pago_preferido == $metodo->id ? 'selected' : '' }}>
                                            {{ $metodo->tipo }} - {{ substr($metodo->numero, -4) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Preferencias de Visualización</h3>

                            <div class="mb-4">
                                <label for="tema" class="block text-sm font-medium text-gray-700 mb-1">Tema</label>
                                <select id="tema" name="tema"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="claro" {{ $preferencias->tema == 'claro' ? 'selected' : '' }}>Claro
                                    </option>
                                    <option value="oscuro" {{ $preferencias->tema == 'oscuro' ? 'selected' : '' }}>Oscuro
                                    </option>
                                    <option value="sistema" {{ $preferencias->tema == 'sistema' ? 'selected' : '' }}>Según
                                        sistema</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="vista_restaurantes" class="block text-sm font-medium text-gray-700 mb-1">Vista
                                    de restaurantes</label>
                                <select id="vista_restaurantes" name="vista_restaurantes"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="grid"
                                        {{ $preferencias->vista_restaurantes == 'grid' ? 'selected' : '' }}>Cuadrícula
                                    </option>
                                    <option value="lista"
                                        {{ $preferencias->vista_restaurantes == 'lista' ? 'selected' : '' }}>Lista</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="restaurantes_por_pagina"
                                    class="block text-sm font-medium text-gray-700 mb-1">Restaurantes por página</label>
                                <select id="restaurantes_por_pagina" name="restaurantes_por_pagina"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                                    <option value="12"
                                        {{ $preferencias->restaurantes_por_pagina == 12 ? 'selected' : '' }}>12</option>
                                    <option value="24"
                                        {{ $preferencias->restaurantes_por_pagina == 24 ? 'selected' : '' }}>24</option>
                                    <option value="36"
                                        {{ $preferencias->restaurantes_por_pagina == 36 ? 'selected' : '' }}>36</option>
                                    <option value="48"
                                        {{ $preferencias->restaurantes_por_pagina == 48 ? 'selected' : '' }}>48</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                                Guardar Preferencias
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Restaurar Configuración Predeterminada</h3>
                    <p class="text-gray-600 mb-4">Esta acción restablecerá todas tus preferencias a los valores
                        predeterminados. Esta acción no se puede deshacer.</p>

                    <form action="{{ route('cliente.configuracion.preferencias.restablecer') }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de restablecer todas tus preferencias a los valores predeterminados?')">
                        @csrf
                        @method('POST')
                        <button type="submit"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                            Restablecer Valores Predeterminados
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
