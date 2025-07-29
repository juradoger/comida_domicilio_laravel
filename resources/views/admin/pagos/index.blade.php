@extends('Layouts.admin')

@section('title', 'Gestión de Pagos')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestión de Pagos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pagos</li>
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
            <i class="fas fa-money-bill-wave me-1"></i>
            Lista de Pagos
            <a href="{{ route('pagos.crear') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i> Nuevo Pago
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Método</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->id_pedido }}</td>
                        <td>{{ $pago->pedido->usuario->name }} {{ $pago->pedido->usuario->apellido }}</td>
                        <td>{{ $pago->metodo_pago }}</td>
                        <td>{{ number_format($pago->monto, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $pago->estado_pago == 'pagado' ? 'success' : ($pago->estado_pago == 'pendiente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pago->estado_pago) }}
                            </span>
                        </td>
                        <td>{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="{{ route('pagos.editar', $pago->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pagos.eliminar', $pago->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este pago?')">
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