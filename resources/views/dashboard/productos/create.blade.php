@extends('Layouts.admin')

@section('title', 'Crear Producto - FastBite')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.productos.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold">Crear Nuevo Producto</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre del producto -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del producto</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nombre') border-red-500 @enderror" 
                           placeholder="Ej: Hamburguesa Clásica" required>
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="id_categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <select name="id_categoria" id="id_categoria" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('id_categoria') border-red-500 @enderror" 
                            required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_categoria')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Precio -->
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio (Bs)</label>
                    <input type="number" name="precio" id="precio" value="{{ old('precio') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('precio') border-red-500 @enderror" 
                           placeholder="0.00" step="0.01" min="0" required>
                    @error('precio')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('stock') border-red-500 @enderror" 
                           placeholder="0" min="0" required>
                    @error('stock')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="md:col-span-2">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" 
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('descripcion') border-red-500 @enderror" 
                              placeholder="Describe el producto..." required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="md:col-span-2">
                    <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen del producto</label>
                    <div class="mt-1 flex items-center">
                        <div id="preview-container" class="hidden mr-4 h-32 w-32 rounded-md border border-gray-300 overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img id="preview-image" src="#" alt="Vista previa" class="h-full w-full object-cover">
                        </div>
                        <label class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span>Seleccionar archivo</span>
                            <input type="file" name="imagen" id="imagen" class="sr-only" accept="image/*" required>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hasta 2MB</p>
                    @error('imagen')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.productos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Vista previa de la imagen
    document.getElementById('imagen').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection