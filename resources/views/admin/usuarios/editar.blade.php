@extends('Layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Usuario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar Usuario #{{ $usuario->id }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i>
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

            <form action="{{ route('usuarios.actualizar', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Nombre" value="{{ old('name', $usuario->name) }}" required />
                            <label for="name">Nombre</label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" type="text" placeholder="Apellido" value="{{ old('apellido', $usuario->apellido) }}" required />
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
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" value="{{ old('email', $usuario->email) }}" required />
                            <label for="email">Email</label>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" type="text" placeholder="Teléfono" value="{{ old('telefono', $usuario->telefono) }}" />
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
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Contraseña" />
                            <label for="password">Contraseña (dejar en blanco para mantener la actual)</label>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar Contraseña" />
                            <label for="password_confirmation">Confirmar Contraseña</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('id_rol') is-invalid @enderror" id="id_rol" name="id_rol" required>
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" {{ (old('id_rol', $usuario->id_rol) == $rol->id) ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                                @endforeach
                            </select>
                            <label for="id_rol">Rol</label>
                            @error('id_rol')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="activo" {{ (old('estado', $usuario->estado) == 'activo') ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ (old('estado', $usuario->estado) == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
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
                        <button type="submit" class="btn btn-primary btn-block">Actualizar Usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection