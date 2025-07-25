@extends('Layouts.admin')

@section('title', 'Editar Pago')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Pago</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Pagos</a></li>
        <li class="breadcrumb-item active">Editar Pago</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-money-bill-wave me-1"></i>
            Formulario de Edición
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

            <form action="{{ route('pagos.actualizar', $pago->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('id_pedido') is-invalid @enderror" id="id_pedido" name="id_pedido" required>
                                <option value="">Seleccione un pedido</option>
                                @foreach($pedidos as $pedido)
                                <option value="{{ $pedido->id }}" {{ old('id_pedido', $pago->id_pedido) == $pedido->id ? 'selected' : '' }}>
                                    #{{ $pedido->id }} - {{ $pedido->usuario->name }} {{ $pedido->usuario->apellido }} - {{ number_format($pedido->total, 2) }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_pedido">Pedido</label>
                            @error('id_pedido')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('metodo_pago') is-invalid @enderror" id="metodo_pago" name="metodo_pago" required>
                                <option value="">Seleccione un método de pago</option>
                                <option value="efectivo" {{ old('metodo_pago', $pago->metodo_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="tarjeta" {{ old('metodo_pago', $pago->metodo_pago) == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                <option value="transferencia" {{ old('metodo_pago', $pago->metodo_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            </select>
                            <label for="metodo_pago">Método de Pago</label>
                            @error('metodo_pago')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('monto') is-invalid @enderror" id="monto" name="monto" type="number" step="0.01" placeholder="Monto" value="{{ old('monto', $pago->monto) }}" required />
                            <label for="monto">Monto</label>
                            @error('monto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="pendiente" {{ old('estado', $pago->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completado" {{ old('estado', $pago->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                                <option value="rechazado" {{ old('estado', $pago->estado) == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                            <label for="estado">Estado</label>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Actualizar Pago</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection