<?php
namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Detalle_pedido;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Muestra el dashboard del cliente con resumen de pedidos recientes.
     */
    public function dashboard()
    {
        $pedidosRecientes = Pedido::where('id_usuario', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $totalPedidos = Pedido::where('id_usuario', Auth::id())->count();
        $pedidosPendientes = Pedido::where('id_usuario', Auth::id())
            ->where('estado', 'pendiente')
            ->count();
            
        return view('cliente.dashboard', compact('pedidosRecientes', 'totalPedidos', 'pedidosPendientes'));
    }

    /**
     * Muestra el menú de productos por categoría.
     */
    public function menu()
    {
        $categorias = Categoria::with(['productos' => function($query) {
            $query->where('estado', 'activo');
        }])->get();
        
        return view('cliente.menu', compact('categorias'));
    }

    /**
     * Muestra los productos de una categoría específica.
     */
    public function productosPorCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = Producto::where('id_categoria', $id)
            ->where('estado', 'activo')
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
    public function pedidos()
    {
        $pedidos = Pedido::where('id_usuario', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('cliente.pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra el formulario para crear un nuevo pedido.
     */
    public function crearPedido()
    {
        $categorias = Categoria::with(['productos' => function($query) {
            $query->where('estado', 'activo');
        }])->get();
        
        return view('cliente.pedidos.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo pedido en la base de datos.
     */
    public function guardarPedido(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'direccion' => 'required|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        // Calcular subtotal, costo de envío y total
        $subtotal = 0;
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            $subtotal += $producto->precio * $item['cantidad'];
        }
        
        $costoEnvio = 10.00; // Valor fijo para ejemplo, podría calcularse según distancia
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
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            Detalle_pedido::create([
                'id_pedido' => $pedido->id,
                'id_producto' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
            ]);
        }

        // Guardar la dirección de entrega
        Direccion::create([
            'id_pedido' => $pedido->id,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        return redirect()->route('cliente.pedidos.show', $pedido->id)
            ->with('success', 'Pedido creado exitosamente. Ahora puedes proceder al pago.');
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
     * Lista todos los clientes (de ClienteControllers).
     */
    public function adminIndex()
    {
        $clientes = User::where('id_rol', 2)->get();
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
            'email' => 'required|email|unique:users,email,'.$cliente->id,
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
}