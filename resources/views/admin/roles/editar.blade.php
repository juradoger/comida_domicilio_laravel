@extends('Layouts.admin')

@section('title', 'Editar Rol')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Rol</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Editar Rol #{{ $rol->id }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-tag me-1"></i>
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

            <form action="{{ route('roles.actualizar', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" type="text" placeholder="Nombre del rol" value="{{ old('nombre', $rol->nombre) }}" required />
                            <label for="nombre">Nombre del rol</label>
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" type="text" placeholder="Descripción" value="{{ old('descripcion', $rol->descripcion) }}" required />
                            <label for="descripcion">Descripción</label>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Actualizar Rol</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection