<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Detalle_pedido;
use App\Models\Direccion;
use App\Models\Pago;
use App\Models\Notificacion;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Muestra el dashboard del cliente con resumen de pedidos recientes.
     */
    public function dashboard()
    {
        return view('inicio');
    }

    /**
     * Muestra el menú de productos por categoría.
     */
    public function menu(Request $request)
    {
        $categorias = Categoria::with(['productos' => function ($query) {
            $query->where('estado', 'disponible');
        }])->get();

        $productos = Producto::where('estado', 'disponible');

        // Filtrar por categoría si se especifica
        if ($request->has('categoria') && $request->categoria) {
            $productos->where('id_categoria', $request->categoria);
        }

        // Filtrar por búsqueda si se especifica
        if ($request->has('buscar') && $request->buscar) {
            $productos->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $productos = $productos->with('categoria')->get();

        return view('menu', compact('categorias', 'productos'));
    }

    /**
     * Muestra los productos de una categoría específica.
     */
    public function productosPorCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = Producto::where('id_categoria', $id)
            ->where('estado', 'disponible')
            ->get();

        return view('cliente.productos_categoria', compact('categoria', 'productos'));
    }

    /**
     * Muestra el detalle de un producto específico.
     */
    public function detalleProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return view('cliente.detalle_producto', compact('producto'));
    }

    /**
     * Muestra la lista de pedidos del cliente.
     */
    public function pedidos(Request $request)
    {
        $query = Pedido::where('id_usuario', Auth::id())
            ->with(['detalles.producto', 'direcciones']);

        // Filtrar por estado si se especifica
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        $pedidos = $query->orderBy('created_at', 'desc')->get();

        return view('cliente.pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra el formulario para crear un nuevo pedido.
     */
    public function crearPedido()
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('cliente.menu')->with('error', 'Tu carrito está vacío. Agrega productos antes de realizar un pedido.');
        }

        return view('cliente.pedidos.create');
    }

    /**
     * Almacena un nuevo pedido en la base de datos.
     */
    public function guardarPedido(Request $request)
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('cliente.menu')->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'metodo_entrega' => 'required|in:domicilio,recoger',
            'direccion' => 'required_if:metodo_entrega,domicilio|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,yape',
        ]);

        // Calcular subtotal
        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        // Calcular costo de envío
        $costoEnvio = $request->metodo_entrega === 'domicilio' ? 10.00 : 0.00;
        $total = $subtotal + $costoEnvio;

        // Crear el pedido
        $pedido = Pedido::create([
            'id_usuario' => Auth::id(),
            'id_empleado' => null, // Se asignará después
            'subtotal' => $subtotal,
            'costo_envio' => $costoEnvio,
            'total' => $total,
            'fecha_entrega' => now()->addHours(1), // Estimación de entrega en 1 hora
            'estado' => 'pendiente',
        ]);

        // Crear los detalles del pedido
        foreach ($carrito as $item) {
            Detalle_pedido::create([
                'id_pedido' => $pedido->id,
                'id_producto' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Guardar la dirección de entrega si es domicilio
        if ($request->metodo_entrega === 'domicilio') {
            Direccion::create([
                'id_pedido' => $pedido->id,
                'direccion' => $request->direccion,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
            ]);
        }

        // Crear el pago automáticamente
        Pago::create([
            'id_pedido' => $pedido->id,
            'metodo_pago' => $request->metodo_pago,
            'monto' => $total,
            'estado_pago' => 'pendiente', // El pago inicia como pendiente
        ]);

        // 🚀 ASIGNACIÓN AUTOMÁTICA DE EMPLEADO DISPONIBLE
        $this->asignarEmpleadoAutomatico($pedido);

        // Crear notificación para el cliente
        Notificacion::create([
            'id_usuario' => Auth::id(),
            'mensaje' => '🎉 ¡Hemos recibido tu pedido #' . $pedido->id . '! Tu deliciosa comida está siendo preparada. Pronto asignaremos un repartidor para entregarte tu orden. Te mantendremos informado sobre el estado de tu pedido.',
            'leido' => false,
            'fecha_envio' => now(),
        ]);

        // Limpiar el carrito
        Session::forget('carrito');

        return redirect()->route('cliente.pedidos.show', $pedido->id)
            ->with('success', 'Pedido creado exitosamente. El pago se ha registrado y está pendiente de procesamiento.');
    }

    /**
     * Muestra los detalles de un pedido específico.
     */
    public function verPedido($id)
    {
        $pedido = Pedido::with(['detalles.producto', 'direcciones'])
            ->findOrFail($id);

        // Verificar que el pedido pertenezca al usuario autenticado
        if ($pedido->id_usuario != Auth::id()) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para ver este pedido.');
        }

        return view('cliente.pedidos.show', compact('pedido'));
    }

    /**
     * Muestra el formulario para editar el perfil del cliente.
     */
    public function editarPerfil()
    {
        $usuario = Auth::user();
        return view('cliente.perfil.edit', compact('usuario'));
    }

    /**
     * Actualiza el perfil del cliente en la base de datos.
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'telefono' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('cliente.perfil.edit')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Elimina el perfil del cliente.
     */
    public function eliminarPerfil()
    {
        $user = Auth::user();
        $user->estado = 'inactivo';
        $user->save();
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Tu cuenta ha sido eliminada lógicamente.']);
    }

    /**
     * Muestra el historial de pedidos del cliente.
     */
    public function historialPedidos()
    {
        $pedidos = Pedido::where('id_usuario', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cliente.pedidos.historial', compact('pedidos'));
    }

    /**
     * Cancela un pedido pendiente.
     */
    public function cancelarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);

        // Verificar que el pedido pertenezca al usuario autenticado
        if ($pedido->id_usuario != Auth::id()) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para cancelar este pedido.');
        }

        // Solo se pueden cancelar pedidos pendientes
        if ($pedido->estado != 'pendiente') {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'Solo se pueden cancelar pedidos pendientes.');
        }

        // Eliminar el pedido y sus relaciones (las migraciones tienen onDelete cascade)
        $pedido->delete();

        return redirect()->route('cliente.pedidos.index')
            ->with('success', 'Pedido cancelado exitosamente.');
    }

    /**
     * Obtiene las notificaciones del usuario autenticado.
     */
    public function obtenerNotificaciones()
    {
        $notificaciones = Notificacion::where('id_usuario', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $noLeidas = Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->count();

        return response()->json([
            'notificaciones' => $notificaciones,
            'no_leidas' => $noLeidas
        ]);
    }

    /**
     * Marca una notificación como leída.
     */
    public function marcarNotificacionLeida($id)
    {
        $notificacion = Notificacion::where('id_usuario', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $notificacion->update(['leido' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marca todas las notificaciones como leídas.
     */
    public function marcarTodasLeidas()
    {
        Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->update(['leido' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Lista todos los clientes (de ClienteControllers).
     */
    public function adminIndex()
    {
        $clientes = User::where('id_rol', 3)->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un cliente (de ClienteControllers).
     */
    public function adminCreate()
    {
        return view('clientes.crear');
    }

    /**
     * Almacena un nuevo cliente en la base de datos (de ClienteControllers).
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'telefono' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'id_rol' => 2
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un cliente (de ClienteControllers).
     */
    public function adminEdit($id)
    {
        $cliente = User::findOrFail($id);
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Actualiza un cliente en la base de datos (de ClienteControllers).
     */
    public function adminUpdate(Request $request, $id)
    {
        $cliente = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:users,email,' . $cliente->id,
            'telefono' => 'nullable',
        ]);

        $cliente->update($request->only('name', 'apellido', 'email', 'telefono'));

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado.');
    }

    /**
     * Elimina un cliente de la base de datos (de ClienteControllers).
     */
    public function adminDestroy($id)
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }

    /**
     * 🚀 Asigna automáticamente un empleado disponible al pedido y lo pone en estado "en_camino"
     */
    private function asignarEmpleadoAutomatico($pedido)
    {
        // Buscar empleados disponibles que no tengan pedidos activos
        $empleadoDisponible = Empleado::with('usuario')
            ->where('estado', 'disponible')
            ->whereDoesntHave('pedidosActivos')
            ->first();

        // Si hay un empleado disponible, asignarlo y cambiar estado
        if ($empleadoDisponible) {
            $pedido->update([
                'id_empleado' => $empleadoDisponible->id,
                'estado' => 'en_camino'
            ]);

            //  update empleado
            $empleadoDisponible->update(['estado' => 'ocupado']);

            Log::info("Pedido #{$pedido->id} asignado automáticamente al empleado {$empleadoDisponible->usuario->name} (ID: {$empleadoDisponible->id})");
        } else {
            Log::info("No hay empleados disponibles para el pedido #{$pedido->id}. Se requiere asignación manual.");
        }

        // Si no hay empleados disponibles, el pedido se queda en estado "pendiente"
        // y se tendrá que asignar manualmente desde el admin
    }
}
