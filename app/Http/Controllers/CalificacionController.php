<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Muestra una lista de calificaciones.
     */
    public function index()
    {
        // Verificar si es un cliente autenticado
        if (Auth::check() && request()->route()->getPrefix() === 'cliente') {
            // Para clientes, mostrar solo sus calificaciones
            $calificaciones = Calificacion::where('id_usuario', Auth::id())
                ->with(['pedido', 'empleado.usuario'])
                ->get();
            return view('cliente.calificaciones.index', compact('calificaciones'));
        }

        // Para admin, mostrar todas las calificaciones
        $calificaciones = Calificacion::with(['pedido', 'usuario', 'empleado'])->get();
        return view('calificaciones.index', compact('calificaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva calificación.
     */
    public function create(Request $request)
    {
        $pedido_id = $request->query('pedido_id');
        $pedido = null;

        if ($pedido_id) {
            $pedido = Pedido::with(['empleado.usuario'])->findOrFail($pedido_id);

            // Verificar si el pedido pertenece al usuario actual
            if (Auth::id() != $pedido->id_usuario) {
                return redirect()->route('cliente.pedidos.index')
                    ->with('error', 'No tienes permiso para calificar este pedido.');
            }

            // Verificar si el pedido ya tiene una calificación
            $calificacionExistente = Calificacion::where('id_pedido', $pedido_id)->first();
            if ($calificacionExistente) {
                return redirect()->route('cliente.pedidos.index')
                    ->with('error', 'Este pedido ya ha sido calificado.');
            }
        }

        return view('cliente.calificaciones.create', compact('pedido'));
    }

    /**
     * Almacena una nueva calificación en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id|unique:calificaciones',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ]);

        // Obtener el pedido para verificar el empleado asociado
        $pedido = Pedido::with('empleado')->findOrFail($request->id_pedido);

        // Verificar si el pedido pertenece al usuario actual
        if (Auth::id() != $pedido->id_usuario) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para calificar este pedido.');
        }

        // Crear la calificación
        Calificacion::create([
            'id_pedido' => $request->id_pedido,
            'id_usuario' => Auth::id(),
            'id_empleado' => $pedido->empleado ? $pedido->empleado->id_usuario : null,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('cliente.pedidos.index')
            ->with('success', 'Calificación enviada exitosamente. ¡Gracias por tu opinión!');
    }

    /**
     * Muestra una calificación específica.
     */
    public function show(Calificacion $calificacion)
    {
        return view('calificaciones.show', compact('calificacion'));
    }

    /**
     * Muestra todas las calificaciones para el administrador.
     */
    public function adminIndex()
    {
        $calificaciones = Calificacion::with(['pedido', 'usuario', 'empleado'])->get();
        return view('admin.calificaciones.index', compact('calificaciones'));
    }

    /**
     * Muestra las calificaciones recibidas por un empleado específico.
     */
    public function empleadoCalificaciones($id_empleado)
    {
        $empleado = User::findOrFail($id_empleado);
        $calificaciones = Calificacion::where('id_empleado', $id_empleado)
            ->with(['pedido', 'usuario'])
            ->get();

        return view('admin.calificaciones.empleado', compact('calificaciones', 'empleado'));
    }

    /**
     * Elimina una calificación específica (solo para administradores).
     */
    public function destroy(Calificacion $calificacion)
    {
        $calificacion->delete();

        return redirect()->route('admin.calificaciones.index')
            ->with('success', 'Calificación eliminada exitosamente.');
    }
}
