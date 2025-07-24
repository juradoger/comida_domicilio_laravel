@extends('Layouts.cliente')

@section('title', 'Mis Direcciones')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Mis Direcciones</h2>
            <button id="nuevaDireccionBtn" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                <i class="fas fa-plus mr-2"></i> Agregar Nueva Dirección
            </button>
        </div>
        
        <!-- Formulario para agregar/editar dirección (oculto por defecto) -->
        <div id="direccionForm" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
            <h3 class="text-xl font-bold text-gray-800 mb-4" id="formTitle">Agregar Nueva Dirección</h3>
            
            <form action="{{ route('cliente.direcciones.store') }}" method="POST" id="direccionFormElement">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="direccion_id" id="direccionId" value="">
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la dirección</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ej: Casa, Trabajo, etc." class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                        <p class="text-xs text-gray-500 mt-1">Un nombre para identificar esta dirección</p>
                    </div>
                    
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección completa</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Calle, número, colonia" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>
                    
                    <div>
                        <label for="referencia" class="block text-sm font-medium text-gray-700 mb-1">Referencia (opcional)</label>
                        <input type="text" name="referencia" id="referencia" placeholder="Ej: Frente al parque" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>
                    
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono de contacto</label>
                        <input type="text" name="telefono" id="telefono" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="predeterminada" id="predeterminada" class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                            <label for="predeterminada" class="ml-2 block text-sm text-gray-700">Establecer como dirección predeterminada</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="cancelarBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition duration-300">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Guardar Dirección
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Listado de direcciones -->
        @if(count($direcciones) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($direcciones as $direccion)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden {{ $direccion->predeterminada ? 'ring-2 ring-orange-500' : '' }}">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $direccion->nombre }}</h3>
                                    @if($direccion->predeterminada)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Predeterminada
                                        </span>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800" onclick="editarDireccion({{ $direccion->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('cliente.direcciones.destroy', $direccion->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta dirección?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="mt-3 space-y-2">
                                <p class="text-gray-700"><i class="fas fa-map-marker-alt text-red-500 mr-2"></i> {{ $direccion->direccion }}</p>
                                @if($direccion->referencia)
                                    <p class="text-gray-600 text-sm"><i class="fas fa-info-circle text-blue-500 mr-2"></i> {{ $direccion->referencia }}</p>
                                @endif
                                <p class="text-gray-700"><i class="fas fa-phone text-green-500 mr-2"></i> {{ $direccion->telefono }}</p>
                            </div>
                            
                            @if(!$direccion->predeterminada)
                                <div class="mt-4">
                                    <form action="{{ route('cliente.direcciones.predeterminada', $direccion->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                                            Establecer como predeterminada
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4">No tienes direcciones guardadas.</p>
                <p class="text-gray-600">Agrega una nueva dirección para facilitar tus pedidos.</p>
            </div>
        @endif
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nuevaDireccionBtn = document.getElementById('nuevaDireccionBtn');
            const cancelarBtn = document.getElementById('cancelarBtn');
            const direccionForm = document.getElementById('direccionForm');
            const formTitle = document.getElementById('formTitle');
            const formMethod = document.getElementById('formMethod');
            const direccionFormElement = document.getElementById('direccionFormElement');
            const direccionId = document.getElementById('direccionId');
            
            nuevaDireccionBtn.addEventListener('click', function() {
                // Resetear formulario
                direccionFormElement.reset();
                formTitle.textContent = 'Agregar Nueva Dirección';
                formMethod.value = 'POST';
                direccionId.value = '';
                direccionFormElement.action = '{{ route("cliente.direcciones.store") }}';
                
                // Mostrar formulario
                direccionForm.classList.remove('hidden');
                
                // Scroll al formulario
                direccionForm.scrollIntoView({ behavior: 'smooth' });
            });
            
            cancelarBtn.addEventListener('click', function() {
                direccionForm.classList.add('hidden');
            });
        });
        
        function editarDireccion(id) {
            fetch(`/cliente/direcciones/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Llenar formulario con datos
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('direccion').value = data.direccion;
                    document.getElementById('referencia').value = data.referencia || '';
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('predeterminada').checked = data.predeterminada;
                    
                    // Configurar formulario para edición
                    document.getElementById('formTitle').textContent = 'Editar Dirección';
                    document.getElementById('formMethod').value = 'PUT';
                    document.getElementById('direccionId').value = data.id;
                    document.getElementById('direccionFormElement').action = `/cliente/direcciones/${data.id}`;
                    
                    // Mostrar formulario
                    document.getElementById('direccionForm').classList.remove('hidden');
                    
                    // Scroll al formulario
                    document.getElementById('direccionForm').scrollIntoView({ behavior: 'smooth' });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection