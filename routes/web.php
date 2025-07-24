<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\RepartoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\AdminController;

// Ruta raíz opcional (si deseas mostrar bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [AuthControllers::class, 'showLogin'])->name('login');
Route::post('/login', [AuthControllers::class, 'login'])->name('login.submit');
Route::get('/register', [AuthControllers::class, 'showRegister'])->name('register');
Route::post('/register', [AuthControllers::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthControllers::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard general
    Route::get('/dashboard', function () {
        return 'Bienvenido al panel';
    })->name('dashboard');

    // Rutas para clientes
    Route::get('/cliente', [ClienteController::class, 'adminIndex'])->name('clientes.index');
    Route::get('/cliente/crear', [ClienteController::class, 'adminCreate'])->name('clientes.crear');
    Route::post('/cliente', [ClienteController::class, 'adminStore'])->name('clientes.guardar');
    Route::get('/cliente/editar/{id}', [ClienteController::class, 'adminEdit'])->name('clientes.editar');
    Route::put('/cliente/actualizar/{id}', [ClienteController::class, 'adminUpdate'])->name('clientes.actualizar');
    Route::delete('/cliente/eliminar/{id}', [ClienteController::class, 'adminDestroy'])->name('clientes.eliminar');

    // Rutas para el rol de cliente
    Route::middleware(['role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
        // Dashboard del cliente
        Route::get('/dashboard', [ClienteController::class, 'dashboard'])->name('dashboard');

        // Menú de productos
        Route::get('/menu', [ClienteController::class, 'menu'])->name('menu');
        Route::get('/productos/categoria/{id}', [ClienteController::class, 'productosPorCategoria'])->name('productos.categoria');
        Route::get('/productos/{id}', [ClienteController::class, 'detalleProducto'])->name('productos.detalle');

        // Carrito de compras
        Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
        Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
        Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
        Route::put('/carrito/{id}', [CarritoController::class, 'actualizar'])->name('carrito.update');
        Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
        Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.destroy');
        Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
        Route::post('/carrito/aplicar-cupon', [CarritoController::class, 'aplicarCupon'])->name('carrito.aplicar-cupon');
        Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');

        // Pedidos
        Route::get('/pedidos', [ClienteController::class, 'pedidos'])->name('pedidos.index');
        Route::get('/pedidos/crear', [ClienteController::class, 'crearPedido'])->name('pedidos.create');
        Route::post('/pedidos', [ClienteController::class, 'guardarPedido'])->name('pedidos.store');
        Route::get('/pedidos/{id}', [ClienteController::class, 'verPedido'])->name('pedidos.show');
        Route::delete('/pedidos/{id}/cancelar', [ClienteController::class, 'cancelarPedido'])->name('pedidos.cancelar');
        Route::get('/pedidos/historial', [ClienteController::class, 'historialPedidos'])->name('pedidos.historial');

        // Perfil del cliente
        Route::get('/perfil', [ClienteController::class, 'editarPerfil'])->name('perfil.edit');
        Route::put('/perfil', [ClienteController::class, 'actualizarPerfil'])->name('perfil.update');

        Route::get('/envio', function () {
            return view('cliente.envio');
        })->name('envio');

        // Rutas para pagos (cliente)
        Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
        Route::get('/pagos/crear', [PagoController::class, 'create'])->name('pagos.crear');
        Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.guardar');
        Route::get('/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.ver');

        // Rutas para calificaciones (cliente)
        Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
        Route::get('/calificaciones/crear', [CalificacionController::class, 'create'])->name('calificaciones.crear');
        Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.guardar');

        // Rutas para notificaciones (cliente)
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::post('/notificaciones/{notificacion}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.marcar_leida');
        Route::post('/notificaciones/todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.marcar_todas_leidas');
        Route::delete('/notificaciones/{notificacion}', [NotificacionController::class, 'destroy'])->name('notificaciones.eliminar');
    });


    // Rutas para empleados
    /*    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.empleados.empleados.empleados.index');
    Route::get('/empleados/crear', [EmpleadoController::class, 'crear'])->name('empleados.empleados.crear');
    Route::post('/empleados', [EmpleadoController::class, 'guardar'])->name('empleados.empleados.guardar');
    Route::get('/empleados/{id}/editar', [EmpleadoController::class, 'editar'])->name('empleados.empleados.editar');
    Route::put('/empleados/{id}', [EmpleadoController::class, 'actualizar'])->name('empleados.empleados.actualizar');
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'eliminar'])->name('empleados.empleados.eliminar');
 */
    // Rutas para el rol de empleado/repartidor
    Route::middleware(['role:empleado'])->prefix('empleado')->name('empleado.')->group(function () {
        // Rutas para listar clientes y repartidores
        Route::get('/clientes', [EmpleadoController::class, 'listarClientes'])->name('clientes');
        Route::get('/repartidores', [EmpleadoController::class, 'listarEmpleados'])->name('repartidores');

        // Rutas para repartos
        Route::get('/repartos', [RepartoController::class, 'index'])->name('repartos.index');
        Route::get('/repartos/crear', [RepartoController::class, 'create'])->name('repartos.crear');
        Route::post('/repartos', [RepartoController::class, 'store'])->name('repartos.guardar');
        Route::get('/repartos/{reparto}', [RepartoController::class, 'show'])->name('repartos.ver');
        Route::get('/repartos/{reparto}/editar', [RepartoController::class, 'edit'])->name('repartos.editar');
        Route::put('/repartos/{reparto}', [RepartoController::class, 'update'])->name('repartos.actualizar');
        Route::post('/repartos/{reparto}/entregado', [RepartoController::class, 'marcarEntregado'])->name('repartos.marcar_entregado');
        Route::delete('/repartos/{reparto}', [RepartoController::class, 'destroy'])->name('repartos.eliminar');

        // Rutas para notificaciones (empleado)
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::post('/notificaciones/{notificacion}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.marcar_leida');
        Route::post('/notificaciones/todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.marcar_todas_leidas');
    });

    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.crear');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.guardar');
    Route::get('/pedidos/{id}/editar', [PedidoController::class, 'edit'])->name('pedidos.editar');
    Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.actualizar');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.eliminar');

    // Rutas para productos (accesibles para admin y empleados)
    Route::middleware(['role:admin,empleado'])->group(function () {
        Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');
        Route::get('/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
        Route::get('/productos/{producto}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');
    });

    // Panel empleado: lista de clientes y empleados
    /*     Route::get('/empleado/clientes', [App\Http\Controllers\EmpleadoController::class, 'listarClientes'])->name('empleado.clientes');
    Route::get('/empleado/repartidores', [App\Http\Controllers\EmpleadoController::class, 'listarEmpleados'])->name('empleado.repartidores');
 */
    // Ruta para logout
    Route::post('/logout', [App\Http\Controllers\AuthControllers::class, 'logout'])->name('logout');

    return view('welcome');
});
