@extends('Layouts.admin')

@section('title', 'Crear Empleado')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Nuevo Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Empleados</a></li>
        <li class="breadcrumb-item active">Crear Empleado</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-plus me-1"></i>
            Formulario de Registro
        </div>
        <div class="card-body">
            <form action="{{ route('empleados.guardar') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Nombre" value="{{ old('name') }}" required />
                            <label for="name">Nombre</label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" type="text" placeholder="Apellido" value="{{ old('apellido') }}" required />
                            <label for="apellido">Apellido</label>
                            @error('apellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required />
                            <label for="email">Email</label>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" type="text" placeholder="Teléfono" value="{{ old('telefono') }}" required />
                            <label for="telefono">Teléfono</label>
                            @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Contraseña" required />
                            <label for="password">Contraseña</label>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar Contraseña" required />
                            <label for="password_confirmation">Confirmar Contraseña</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" type="text" placeholder="DNI" value="{{ old('dni') }}" required />
                            <label for="dni">DNI</label>
                            @error('dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('licencia_conducir') is-invalid @enderror" id="licencia_conducir" name="licencia_conducir" type="text" placeholder="Licencia de Conducir" value="{{ old('licencia_conducir') }}" />
                            <label for="licencia_conducir">Licencia de Conducir</label>
                            @error('licencia_conducir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('fecha_ingreso') is-invalid @enderror" id="fecha_ingreso" name="fecha_ingreso" type="date" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required />
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            @error('fecha_ingreso')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
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
                        <button type="submit" class="btn btn-primary btn-block">Guardar Empleado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection