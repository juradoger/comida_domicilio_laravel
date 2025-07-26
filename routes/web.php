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
use App\Http\Controllers\HomeController;

// Ruta raíz opcional (si deseas mostrar bienvenida)
//Route::redirect('/', '/login');

// Rutas de autenticación
Route::get('/login', [AuthControllers::class, 'showLogin'])->name('login');
Route::post('/login', [AuthControllers::class, 'login'])->name('login.submit');
Route::get('/register', [AuthControllers::class, 'showRegister'])->name('register');
Route::post('/register', [AuthControllers::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthControllers::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'dashboard'])->name('inicio');
Route::get('/menu', [HomeController::class, 'menu'])->name('menuGuess');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard general
    Route::get('/dashboard', function () {
        return 'Bienvenido al panel';
    })->name('dashboard');

    // Rutas para clientes
    Route::get('/cliente', function () {
        return redirect('/cliente/dashboard');
    });
    Route::get('/clientes', [ClienteController::class, 'adminIndex'])->name('clientes.index');
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
        Route::delete('/perfil', [ClienteController::class, 'eliminarPerfil'])->name('perfil.destroy');

        Route::get('/envio', function () {
            return view('cliente.envio');
        })->name('envio');

        // Rutas para pagos (cliente)
        Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
        Route::get('/pagos/crear', [PagoController::class, 'create'])->name('pagos.crear');
        Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.guardar');
        Route::get('/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.show');

        // Rutas para calificaciones (cliente)
        Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
        Route::get('/calificaciones/crear', [CalificacionController::class, 'create'])->name('calificaciones.crear');
        Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.guardar');

        // Rutas para notificaciones (cliente)
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::post('/notificaciones/{notificacion}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.marcar_leida');
        Route::post('/notificaciones/todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.marcar_todas_leidas');
        Route::delete('/notificaciones/{notificacion}', [NotificacionController::class, 'destroy'])->name('notificaciones.eliminar');

        // API para notificaciones (para el dropdown en el layout)
        Route::get('/api/notificaciones', [ClienteController::class, 'obtenerNotificaciones'])->name('api.notificaciones');
        Route::post('/api/notificaciones/{id}/leida', [ClienteController::class, 'marcarNotificacionLeida'])->name('api.notificaciones.leida');
        Route::post('/api/notificaciones/todas-leidas', [ClienteController::class, 'marcarTodasLeidas'])->name('api.notificaciones.todas-leidas');
    });



    // Rutas para empleados
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/crear', [EmpleadoController::class, 'crear'])->name('empleados.crear');
    Route::post('/empleados', [EmpleadoController::class, 'guardar'])->name('empleados.guardar');
    Route::get('/empleados/{id}/editar', [EmpleadoController::class, 'editar'])->name('empleados.editar');
    Route::put('/empleados/{id}', [EmpleadoController::class, 'actualizar'])->name('empleados.actualizar');
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'eliminar'])->name('empleados.eliminar');
    Route::get('/admin/empleados/{id}', [AdminController::class, 'verEmpleado'])->name('admin.empleados.ver');

    // Rutas para categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    // Rutas para pagos
    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('/pagos/crear', [PagoController::class, 'create'])->name('pagos.crear');
    Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.guardar');
    Route::get('/pagos/{pago}/editar', [PagoController::class, 'edit'])->name('pagos.editar');
    Route::put('/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.actualizar');
    Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.eliminar');

    // Rutas para roles
    Route::get('/roles', [App\Http\Controllers\RolController::class, 'index'])->name('roles.index');
    Route::get('/roles/crear', [App\Http\Controllers\RolController::class, 'create'])->name('roles.crear');
    Route::post('/roles', [App\Http\Controllers\RolController::class, 'store'])->name('roles.guardar');
    Route::get('/roles/{rol}/editar', [App\Http\Controllers\RolController::class, 'edit'])->name('roles.editar');
    Route::put('/roles/{rol}', [App\Http\Controllers\RolController::class, 'update'])->name('roles.actualizar');
    Route::delete('/roles/{rol}', [App\Http\Controllers\RolController::class, 'destroy'])->name('roles.eliminar');

    // Rutas para usuarios
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [App\Http\Controllers\UserController::class, 'create'])->name('usuarios.crear');
    Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('usuarios.guardar');
    Route::get('/usuarios/{usuario}/editar', [App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.editar');
    Route::put('/usuarios/{usuario}', [App\Http\Controllers\UserController::class, 'update'])->name('usuarios.actualizar');
    Route::delete('/usuarios/{usuario}', [App\Http\Controllers\UserController::class, 'destroy'])->name('usuarios.eliminar');



    // Rutas para pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.crear');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.guardar');
    Route::get('/pedidos/{id}/editar', [PedidoController::class, 'edit'])->name('pedidos.editar');
    Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.actualizar');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.eliminar');

    // Rutas para productos
    Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.crear');
    Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.guardar');
    Route::get('/productos/{producto}/editar', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.editar');
    Route::put('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.actualizar');
    Route::delete('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.eliminar');

    // Panel empleado: lista de clientes y empleados
    /*     Route::get('/empleado/clientes', [App\Http\Controllers\EmpleadoController::class, 'listarClientes'])->name('empleado.clientes');
    Route::get('/empleado/repartidores', [App\Http\Controllers\EmpleadoController::class, 'listarEmpleados'])->name('empleado.repartidores');
 */
    // Ruta para logout
    Route::post('/logout', [App\Http\Controllers\AuthControllers::class, 'logout'])->name('logout');

    return view('welcome');
});
