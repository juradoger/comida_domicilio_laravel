@extends('Layouts.admin')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestión de Empleados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Empleados</li>
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
            <i class="fas fa-table me-1"></i>
            Lista de Empleados
            <a href="{{ route('empleados.crear') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i> Nuevo Empleado
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>DNI</th>
                        <th>Licencia</th>
                        <th>Fecha Ingreso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->usuario->name }} {{ $empleado->usuario->apellido }}</td>
                        <td>{{ $empleado->usuario->email }}</td>
                        <td>{{ $empleado->usuario->telefono }}</td>
                        <td>{{ $empleado->dni }}</td>
                        <td>{{ $empleado->licencia_conducir }}</td>
                        <td>{{ $empleado->fecha_ingreso }}</td>
                        <td>
                            <span class="badge bg-{{ $empleado->estado == 'activo' ? 'success' : 'danger' }}">
                                {{ $empleado->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('admin.empleados.ver', $empleado->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('empleados.editar', $empleado->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('empleados.eliminar', $empleado->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este empleado?')">
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
        $('#datatablesSimple').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });
</script>
@endsection