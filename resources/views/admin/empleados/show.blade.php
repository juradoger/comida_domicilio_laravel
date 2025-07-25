@extends('Layouts.admin')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detalles del Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Empleados</a></li>
        <li class="breadcrumb-item active">Detalles del Empleado</li>
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

    <!-- Información del Empleado -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user me-1"></i>
            Información del Empleado
            <a href="{{ route('empleados.editar', $empleado->empleado->id) }}" class="btn btn-warning btn-sm float-end ms-2">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Datos Personales</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID:</strong> {{ $empleado->id }}</li>
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $empleado->name }} {{ $empleado->apellido }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $empleado->email }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $empleado->telefono }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">Datos Laborales</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>DNI:</strong> {{ $empleado->empleado->dni }}</li>
                        <li class="list-group-item"><strong>Licencia de Conducir:</strong> {{ $empleado->empleado->licencia_conducir }}</li>
                        <li class="list-group-item"><strong>Fecha de Ingreso:</strong> {{ $empleado->empleado->fecha_ingreso }}</li>
                        <li class="list-group-item">
                            <strong>Estado:</strong> 
                            <span class="badge bg-{{ $empleado->empleado->estado == 'activo' ? 'success' : 'danger' }}">
                                {{ $empleado->empleado->estado }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas del Empleado -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ $pedidosAsignados->count() }}</h5>
                            <div class="small">Pedidos Asignados</div>
                        </div>
                        <div>
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ $pedidosAsignados->where('estado', 'entregado')->count() }}</h5>
                            <div class="small">Pedidos Entregados</div>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ $pedidosAsignados->whereIn('estado', ['pendiente', 'en preparacion', 'en camino'])->count() }}</h5>
                            <div class="small">Pedidos en Proceso</div>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ number_format($promedioCalificacion, 1) }}</h5>
                            <div class="small">Calificación Promedio</div>
                        </div>
                        <div>
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pedidos Asignados -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-shopping-cart me-1"></i>
            Pedidos Asignados
        </div>
        <div class="card-body">
            <table id="pedidosTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha Entrega</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidosAsignados as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->usuario->name }} {{ $pedido->usuario->apellido }}</td>
                        <td>{{ number_format($pedido->total, 2) }}</td>
                        <td>{{ $pedido->fecha_entrega ? $pedido->fecha_entrega->format('d/m/Y H:i') : 'No programada' }}</td>
                        <td>
                            <span class="badge bg-{{ $pedido->estado == 'pendiente' ? 'warning' : 
                                ($pedido->estado == 'en preparacion' ? 'info' : 
                                ($pedido->estado == 'en camino' ? 'primary' : 
                                ($pedido->estado == 'entregado' ? 'success' : 'danger'))) }}">
                                {{ $pedido->estado }}
                            </span>
                        </td>
                        <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('pedidos.editar', $pedido->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Calificaciones Recibidas -->
    @if($calificaciones->count() > 0)
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-star me-1"></i>
            Calificaciones Recibidas
        </div>
        <div class="card-body">
            <table id="calificacionesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Calificación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calificaciones as $calificacion)
                    <tr>
                        <td>{{ $calificacion->pedido->id }}</td>
                        <td>{{ $calificacion->usuario->name }} {{ $calificacion->usuario->apellido }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $calificacion->calificacion)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            ({{ $calificacion->calificacion }})
                        </td>
                        <td>{{ $calificacion->comentario }}</td>
                        <td>{{ $calificacion->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#pedidosTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            order: [[5, 'desc']]
        });
        
        $('#calificacionesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            order: [[4, 'desc']]
        });
    });
</script>
@endsection