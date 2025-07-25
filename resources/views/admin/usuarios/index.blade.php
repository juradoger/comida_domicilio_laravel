@extends('Layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestión de Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
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
            <i class="fas fa-users me-1"></i>
            Lista de Usuarios
            <a href="{{ route('usuarios.crear') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select id="filtroRol" class="form-select">
                        <option value="">Todos los roles</option>
                        @foreach($roles as $rol)
                        <option value="{{ $rol->nombre }}">{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filtroEstado" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }} {{ $usuario->apellido }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->nombre }}</td>
                        <td>
                            <span class="badge bg-{{ $usuario->estado == 'activo' ? 'success' : 'danger' }}">
                                {{ ucfirst($usuario->estado) }}
                            </span>
                        </td>
                        <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('usuarios.desactivar', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de desactivar este usuario?')">
                                        <i class="fas fa-user-slash"></i>
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
        
        // Filtro por rol
        $('#filtroRol').on('change', function() {
            table.column(3).search($(this).val()).draw();
        });
        
        // Filtro por estado
        $('#filtroEstado').on('change', function() {
            table.column(4).search($(this).val()).draw();
        });
    });
</script>
@endsection