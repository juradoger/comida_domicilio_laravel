@extends('Layouts.cliente')

@section('title', 'Editar Perfil')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Editar Perfil</h1>
                <a href="{{ route('cliente.dashboard') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                    ← Volver al dashboard
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cliente.perfil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Información personal -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}"
                                required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellido *</label>
                            <input type="text" id="apellido" name="apellido"
                                value="{{ old('apellido', $usuario->apellido) }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico
                            *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono *</label>
                        <input type="tel" id="telefono" name="telefono"
                            value="{{ old('telefono', $usuario->telefono) }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Ej: +52 555 123 4567">
                    </div>

                    <!-- Cambio de contraseña -->
                    <div class="border-t pt-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Cambiar Contraseña</h2>
                        <p class="text-sm text-gray-600 mb-4">Deja estos campos vacíos si no deseas cambiar tu contraseña
                        </p>

                        <div class="space-y-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nueva
                                    Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Mínimo 8 caracteres">
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Confirmar Nueva Contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Confirma tu nueva contraseña">
                            </div>
                        </div>
                    </div>

                    <!-- Información de cuenta -->
                    <div class="border-t pt-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Información de Cuenta</h2>

                        <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Miembro desde:</span>
                                <span class="font-medium">{{ $usuario->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Última actualización:</span>
                                <span class="font-medium">{{ $usuario->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Rol:</span>
                                <span class="font-medium capitalize">
                                    @if ($usuario->rol)
                                        {{ $usuario->rol->nombre }}
                                    @else
                                        Cliente
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-between items-center pt-6">
                        <button type="button" onclick="confirmarEliminacion()"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                            Eliminar Cuenta
                        </button>

                        <div class="space-x-4">
                            <a href="{{ route('cliente.dashboard') }}"
                                class="px-6 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition font-medium">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Acciones adicionales -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Configuración adicional</h2>

            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-medium text-gray-800">Notificaciones por correo</h3>
                        <p class="text-sm text-gray-600">Recibe actualizaciones sobre tus pedidos</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                        </div>
                    </label>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-medium text-gray-800">Notificaciones push</h3>
                        <p class="text-sm text-gray-600">Recibe notificaciones en tiempo real</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar cuenta -->
    <div id="modal-eliminar" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirmar eliminación de cuenta</h3>
                <p class="text-gray-600 mb-6">Esta acción no se puede deshacer. Se eliminarán todos tus datos y pedidos.
                </p>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="cerrarModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                        Cancelar
                    </button>
                    <form action="#" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Eliminar cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmarEliminacion() {
                document.getElementById('modal-eliminar').classList.remove('hidden');
            }

            function cerrarModal() {
                document.getElementById('modal-eliminar').classList.add('hidden');
            }

            // Validación de contraseñas
            document.getElementById('password_confirmation').addEventListener('input', function() {
                const password = document.getElementById('password').value;
                const confirmation = this.value;

                if (password && confirmation && password !== confirmation) {
                    this.setCustomValidity('Las contraseñas no coinciden');
                } else {
                    this.setCustomValidity('');
                }
            });
        </script>
    @endpush
@endsection
