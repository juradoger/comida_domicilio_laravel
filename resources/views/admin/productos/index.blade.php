@extends('Layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestión de Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-utensils me-1"></i>
            Lista de Productos
            <a href="{{ route('productos.crear') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select id="filtroCategoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filtroEstado" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="disponible">Disponible</option>
                        <option value="agotado">Agotado</option>
                    </select>
                </div>
            </div>
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="max-width: 50px;">
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ number_format($producto->precio, 2) }}</td>
                        <td class="{{ $producto->stock < 10 ? 'text-danger fw-bold' : '' }}">{{ $producto->stock }}</td>
                        <td>
                            <span class="badge bg-{{ $producto->estado == 'disponible' ? 'success' : 'danger' }}">
                                {{ ucfirst($producto->estado) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('productos.editar', $producto->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#datatablesSimple').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
        
        // Filtro por categoría
        $('#filtroCategoria').on('change', function() {
            table.column(3).search($(this).val()).draw();
        });
        
        // Filtro por estado
        $('#filtroEstado').on('change', function() {
            table.column(6).search($(this).val()).draw();
        });
    });
</script>
@endsection