<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Detalle_pedido;
use App\Models\Pago;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Muestra el dashboard del administrador con estadísticas generales.
     */
    public function dashboard()
    {
        // Estadísticas generales
        $totalPedidos = Pedido::count();
        $pedidosHoy = Pedido::whereDate('created_at', Carbon::today())->count();
        $totalClientes = User::where('id_rol', 2)->count();
        $totalEmpleados = User::where('id_rol', 1)->count();
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        
        // Ingresos
        $ingresoTotal = Pago::where('estado_pago', 'pagado')->sum('monto');
        $ingresoHoy = Pago::where('estado_pago', 'pagado')
            ->whereDate('created_at', Carbon::today())
            ->sum('monto');
        
        // Productos más vendidos
        $productosMasVendidos = Detalle_pedido::select('id_producto', DB::raw('SUM(cantidad) as total_vendido'))
            ->with('producto')
            ->groupBy('id_producto')
            ->orderBy('total_vendido', 'desc')
            ->take(5)
            ->get();
        
        // Pedidos recientes
        $pedidosRecientes = Pedido::with(['usuario', 'empleado'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Estadísticas por día de la semana actual
        $pedidosPorDia = Pedido::select(DB::raw('DATE(created_at) as fecha'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalPedidos', 'pedidosHoy', 'totalClientes', 'totalEmpleados',
            'totalProductos', 'totalCategorias', 'ingresoTotal', 'ingresoHoy',
            'productosMasVendidos', 'pedidosRecientes', 'pedidosPorDia'
        ));
    }

    /**
     * Muestra estadísticas detalladas de ventas.
     */
    public function estadisticas()
    {
        // Ventas por mes (últimos 12 meses)
        $ventasPorMes = Pago::select(
                DB::raw('YEAR(created_at) as año'),
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('SUM(monto) as total')
            )
            ->where('estado_pago', 'pagado')
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('año', 'mes')
            ->orderBy('año')
            ->orderBy('mes')
            ->get();
        
        // Ventas por categoría
        $ventasPorCategoria = Categoria::select('categorias.nombre', DB::raw('SUM(detalle_pedidos.cantidad * detalle_pedidos.precio_unitario) as total'))
            ->join('productos', 'categorias.id', '=', 'productos.id_categoria')
            ->join('detalle_pedidos', 'productos.id', '=', 'detalle_pedidos.id_producto')
            ->join('pedidos', 'detalle_pedidos.id_pedido', '=', 'pedidos.id')
            ->join('pagos', 'pedidos.id', '=', 'pagos.id_pedido')
            ->where('pagos.estado_pago', 'pagado')
            ->groupBy('categorias.nombre')
            ->get();
        
        // Calificaciones promedio
        $calificacionesPromedio = Calificacion::select(
                'users.name',
                'users.apellido',
                DB::raw('AVG(calificaciones.calificacion) as promedio'),
                DB::raw('COUNT(calificaciones.id) as total')
            )
            ->join('users', 'calificaciones.id_empleado', '=', 'users.id')
            ->groupBy('users.id', 'users.name', 'users.apellido')
            ->having('total', '>=', 3) // Solo empleados con al menos 3 calificaciones
            ->orderBy('promedio', 'desc')
            ->get();
        
        return view('admin.estadisticas', compact('ventasPorMes', 'ventasPorCategoria', 'calificacionesPromedio'));
    }

    /**
     * Muestra todos los pedidos con opciones de filtrado.
     */
    public function pedidos(Request $request)
    {
        $query = Pedido::with(['usuario', 'empleado.usuario', 'detalles.producto']);
        
        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        if ($request->filled('cliente')) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->cliente . '%')
                  ->orWhere('apellido', 'like', '%' . $request->cliente . '%');
            });
        }
        
        $pedidos = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Muestra los detalles de un pedido específico.
     */
    public function verPedido($id)
    {
        $pedido = Pedido::with([
            'usuario', 
            'empleado.usuario', 
            'detalles.producto',
            'direcciones',
            'pagos',
            'calificacion',
            'reparto.repartidor'
        ])->findOrFail($id);
        
        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Muestra la lista de todos los clientes.
     */
    public function clientes()
    {
        $clientes = User::where('id_rol', 2)
            ->withCount('pedidos')
            ->orderBy('name')
            ->paginate(15);
            
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Muestra los detalles de un cliente específico.
     */
    public function verCliente($id)
    {
        $cliente = User::where('id_rol', 2)->findOrFail($id);
        $pedidos = Pedido::where('id_usuario', $id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalGastado = Pago::whereHas('pedido', function($query) use ($id) {
            $query->where('id_usuario', $id);
        })->where('estado_pago', 'pagado')->sum('monto');
        
        return view('admin.clientes.show', compact('cliente', 'pedidos', 'totalGastado'));
    }

    /**
     * Muestra la lista de todos los empleados.
     */
    public function empleados()
    {
        $empleados = User::where('id_rol', 1)
            ->with('empleado')
            ->orderBy('name')
            ->paginate(15);
            
        return view('admin.empleados.index', compact('empleados'));
    }

    /**
     * Muestra los detalles de un empleado específico.
     */
    public function verEmpleado($id)
    {
        $empleado = User::where('id_rol', 1)->with('empleado')->findOrFail($id);
        
        $pedidosAsignados = Pedido::where('id_empleado', $empleado->empleado->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $calificaciones = Calificacion::where('id_empleado', $id)
            ->with(['pedido', 'usuario'])
            ->get();
            
        $promedioCalificacion = $calificaciones->avg('calificacion');
        
        return view('admin.empleados.show', compact('empleado', 'pedidosAsignados', 'calificaciones', 'promedioCalificacion'));
    }

    /**
     * Asigna un empleado a un pedido.
     */
    public function asignarEmpleado(Request $request, $id)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->id_empleado = $request->id_empleado;
        $pedido->save();

        return redirect()->route('admin.pedidos.show', $id)
            ->with('success', 'Empleado asignado exitosamente.');
    }

    /**
     * Cambia el estado de un pedido.
     */
    public function cambiarEstadoPedido(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_camino,entregado',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->route('admin.pedidos.show', $id)
            ->with('success', 'Estado del pedido actualizado exitosamente.');
    }
}