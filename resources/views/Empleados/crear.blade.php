@extends('layouts.plantilla')

@section('content')
    <div class="container">
        <h2>Crear nuevo empleado</h2>

        <form action="{{ route('empleados.empleados.guardar') }}" method="POST">
            @csrf

            <h4>Datos del Usuario</h4>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <h4>Datos del Empleado</h4>
            <div class="form-group">
                <label>Fecha de Ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Estado</label>
                <input type="text" name="estado" class="form-control" required value="disponible">
            </div>

            <div class="form-group">
                <label>Cargo</label>
                <input type="text" name="cargo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
@endsection
