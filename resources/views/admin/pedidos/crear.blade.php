@extends('Layouts.admin')

@section('title', 'Crear Pedido')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Nuevo Pedido</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
        <li class="breadcrumb-item active">Crear Pedido</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-shopping-cart me-1"></i>
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

            <form action="{{ route('pedidos.guardar') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }} {{ $usuario->apellido }} - {{ $usuario->email }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_usuario">Cliente</label>
                            @error('id_usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('id_empleado') is-invalid @enderror" id="id_empleado" name="id_empleado">
                                <option value="">Seleccione un empleado (opcional)</option>
                                @foreach($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ old('id_empleado') == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->usuario->name }} {{ $empleado->usuario->apellido }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_empleado">Empleado</label>
                            @error('id_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" type="number" step="0.01" placeholder="Total" value="{{ old('total') }}" required />
                            <label for="total">Total</label>
                            @error('total')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('subtotal') is-invalid @enderror" id="subtotal" name="subtotal" type="number" step="0.01" placeholder="Subtotal" value="{{ old('subtotal') }}" required />
                            <label for="subtotal">Subtotal</label>
                            @error('subtotal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('costo_envio') is-invalid @enderror" id="costo_envio" name="costo_envio" type="number" step="0.01" placeholder="Costo de Envío" value="{{ old('costo_envio') }}" required />
                            <label for="costo_envio">Costo de Envío</label>
                            @error('costo_envio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('fecha_entrega') is-invalid @enderror" id="fecha_entrega" name="fecha_entrega" type="datetime-local" value="{{ old('fecha_entrega') }}" />
                            <label for="fecha_entrega">Fecha de Entrega (opcional)</label>
                            @error('fecha_entrega')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en preparacion" {{ old('estado') == 'en preparacion' ? 'selected' : '' }}>En preparación</option>
                                <option value="en camino" {{ old('estado') == 'en camino' ? 'selected' : '' }}>En camino</option>
                                <option value="entregado" {{ old('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
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
                        <button type="submit" class="btn btn-primary btn-block">Guardar Pedido</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection