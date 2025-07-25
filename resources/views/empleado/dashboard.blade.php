<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        Panel Empleado
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('empleado.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('empleado.clientes') }}">
                                Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('empleado.repartidores') }}">
                                Repartidores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('empleado.repartos.index') }}">
                                Repartos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('empleado.notificaciones.index') }}">
                                Notificaciones
                            </a>
                        </li>
                    </ul>

                    <hr>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Empleado</h1>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <h4>¡Bienvenido, {{ auth()->user()->name }}!</h4>
                            <p>Desde aquí puedes gestionar repartos, ver clientes y realizar tus tareas diarias.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Repartos Pendientes</div>
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">Repartos asignados por entregar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Repartos Completados</div>
                            <div class="card-body">
                                <h5 class="card-title">0</h5>
                                <p class="card-text">Repartos entregados hoy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header">Calificación Promedio</div>
                            <div class="card-body">
                                <h5 class="card-title">N/A</h5>
                                <p class="card-text">Tu calificación actual</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('empleado.clientes') }}"
                                            class="btn btn-outline-primary btn-block">
                                            Ver Clientes
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('empleado.repartos.index') }}"
                                            class="btn btn-outline-success btn-block">
                                            Gestionar Repartos
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('empleado.repartidores') }}"
                                            class="btn btn-outline-info btn-block">
                                            Ver Repartidores
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('empleado.notificaciones.index') }}"
                                            class="btn btn-outline-warning btn-block">
                                            Notificaciones
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
