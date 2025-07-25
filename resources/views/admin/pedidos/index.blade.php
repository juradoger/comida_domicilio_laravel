@extends('Layouts.admin')

@section('title', 'Gestión de Pedidos')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestión de Pedidos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pedidos</li>
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
            <i class="fas fa-shopping-cart me-1"></i>
            Lista de Pedidos
            <a href="{{ route('pedidos.crear') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i> Nuevo Pedido
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select id="filtroEstado" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en preparacion">En preparación</option>
                        <option value="en camino">En camino</option>
                        <option value="entregado">Entregado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>
            </div>
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Total</th>
                        <th>Fecha Entrega</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->usuario->name }} {{ $pedido->usuario->apellido }}</td>
                        <td>{{ $pedido->empleado ? $pedido->empleado->usuario->name . ' ' . $pedido->empleado->usuario->apellido : 'No asignado' }}</td>
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
                                <form action="{{ route('pedidos.eliminar', $pedido->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este pedido?')">
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
        
        // Filtro por estado
        $('#filtroEstado').on('change', function() {
            table.column(5).search($(this).val()).draw();
        });
    });
</script>
@endsection