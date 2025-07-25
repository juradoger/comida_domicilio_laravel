@extends('Layouts.admin')

@section('title', 'Crear Producto')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Nuevo Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Crear Producto</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-utensils me-1"></i>
            Formulario de Registro
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('productos.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" type="text" placeholder="Nombre del producto" value="{{ old('nombre') }}" required />
                            <label for="nombre">Nombre del producto</label>
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('id_categoria') is-invalid @enderror" id="id_categoria" name="id_categoria" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_categoria">Categoría</label>
                            @error('id_categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" type="number" step="0.01" placeholder="Precio" value="{{ old('precio') }}" required />
                            <label for="precio">Precio</label>
                            @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" type="number" placeholder="Stock" value="{{ old('stock') }}" required />
                            <label for="stock">Stock</label>
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" style="height: 100px" placeholder="Descripción" required>{{ old('descripcion') }}</textarea>
                            <label for="descripcion">Descripción</label>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del producto</label>
                            <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" type="file" accept="image/*" required />
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                            @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="agotado" {{ old('estado') == 'agotado' ? 'selected' : '' }}>Agotado</option>
                            </select>
                            <label for="estado">Estado</label>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div id="preview-container" class="text-center d-none mb-3">
                            <img id="preview-image" src="#" alt="Vista previa" class="img-fluid img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Guardar Producto</button>
                    </div>
                </div>
            </form>
        </div>
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
                previewContainer.classList.remove('d-none');
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection