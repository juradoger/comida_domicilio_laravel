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

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal con estadísticas generales.
     */
    public function index()
    {
        // Estadísticas generales
        $totalPedidos = Pedido::count();
        $pedidosHoy = Pedido::whereDate('created_at', Carbon::today())->count();
        $totalClientes = User::where('id_rol', 2)->count(); // Asumiendo que rol 2 es cliente
        $clientesNuevosMes = User::where('id_rol', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $stockBajo = Producto::where('stock', '<', 10)->count();
        
        // Ventas del día
        $ventasDelDia = Pago::where('estado_pago', 'pagado')
            ->whereDate('created_at', Carbon::today())
            ->sum('monto');
            
        // Ingresos totales y de hoy
        $ingresosTotales = Pago::where('estado_pago', 'pagado')->sum('monto');
        $ingresosHoy = Pago::where('estado_pago', 'pagado')
            ->whereDate('created_at', Carbon::today())
            ->sum('monto');
            
        // Total de empleados y calificación promedio
        $totalEmpleados = Empleado::count();
        $promedioCalificacionEmpleados = Calificacion::avg('calificacion') ?? 0;
        $promedioCalificacionEmpleados = number_format($promedioCalificacionEmpleados, 1);
            
        // Estado de pedidos (para gráfico)
        $estadoPedidos = Pedido::select('estado', DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->get()
            ->pluck('total', 'estado')
            ->toArray();
            
        // Ingresos mensuales (para gráfico)
        $ingresosMensuales = [];
        for ($i = 1; $i <= 12; $i++) {
            $ingresosMes = Pago::where('estado_pago', 'pagado')
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('monto');
            $ingresosMensuales[$i] = $ingresosMes;
        }
            
        // Productos más vendidos
        $productosMasVendidos = Detalle_pedido::select('id_producto', 
                DB::raw('SUM(cantidad) as cantidad_vendida'), 
                DB::raw('SUM(cantidad * precio_unitario) as ingresos'))
            ->with(['producto' => function($query) {
                $query->select('id', 'nombre', 'id_categoria')
                      ->with(['categoria' => function($q) {
                          $q->select('id', 'nombre');
                      }]);
            }])
            ->groupBy('id_producto')
            ->orderBy('cantidad_vendida', 'desc')
            ->take(5)
            ->get();
            
        // Pedidos recientes
        $pedidosRecientes = Pedido::with(['cliente' => function($query) {
                $query->select('id', 'name', 'surname', 'email');
            }])
            ->select('id', 'id_cliente', 'estado', 'total', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Datos para el gráfico de pedidos por día (semana actual)
        $fechaInicio = Carbon::now()->startOfWeek();
        $fechaFin = Carbon::now()->endOfWeek();
        
        $pedidosPorDia = Pedido::whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->select(DB::raw('DATE(created_at) as fecha'), DB::raw('count(*) as total'))
            ->groupBy('fecha')
            ->get()
            ->pluck('total', 'fecha')
            ->toArray();
            
        $diasSemana = [];
        $datosPedidos = [];
        
        for ($i = 0; $i < 7; $i++) {
            $fecha = $fechaInicio->copy()->addDays($i);
            $diasSemana[] = $fecha->locale('es')->dayName;
            $datosPedidos[] = $pedidosPorDia[$fecha->toDateString()] ?? 0;
        }
        
        // Convertir los datos de pedidos por día a formato para el gráfico
        $pedidosPorDia = $datosPedidos;
        
        // Calcular el total de usuarios (clientes + empleados + administradores)
        $totalUsuarios = User::count();
        
        // Calcular productos más vendidos con formato correcto para la vista
        $productosMasVendidosFormateados = [];
        foreach ($productosMasVendidos as $producto) {
            if (isset($producto->producto)) {
                $productosMasVendidosFormateados[] = [
                    'nombre' => $producto->producto->nombre,
                    'categoria' => $producto->producto->categoria->nombre ?? 'Sin categoría',
                    'cantidad_vendida' => $producto->cantidad_vendida,
                    'ingresos' => $producto->ingresos,
                    'imagen' => $producto->producto->imagen ?? 'productos/default.jpg'
                ];
            }
        }
        
        // Formatear pedidos recientes para la vista
        $pedidosRecientesFormateados = [];
        foreach ($pedidosRecientes as $pedido) {
            $pedidosRecientesFormateados[] = [
                'id' => $pedido->id,
                'cliente' => $pedido->cliente->name . ' ' . ($pedido->cliente->surname ?? ''),
                'estado' => $pedido->estado,
                'total' => $pedido->total,
                'fecha' => $pedido->created_at->format('d/m/Y H:i')
            ];
        }
            
        return view('admin.dashboard', compact(
            'totalPedidos', 
            'pedidosHoy', 
            'totalClientes', 
            'clientesNuevosMes',
            'stockBajo',
            'ventasDelDia',
            'ingresosTotales',
            'ingresosHoy',
            'totalEmpleados',
            'promedioCalificacionEmpleados',
            'estadoPedidos',
            'ingresosMensuales',
            'productosMasVendidos',
            'pedidosRecientes',
            'diasSemana',
            'pedidosPorDia',
            'totalUsuarios'
        ));
    }
    }
}