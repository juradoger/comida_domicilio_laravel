<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Muestra las notificaciones del usuario autenticado.
     */
    public function index()
    {
        $notificaciones = Notificacion::where('id_usuario', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('notificaciones.index', compact('notificaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva notificación (solo admin).
     */
    public function create()
    {
        $usuarios = User::all();
        return view('admin.notificaciones.create', compact('usuarios'));
    }

    /**
     * Almacena una nueva notificación en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'mensaje' => 'required|string',
        ]);

        Notificacion::create([
            'id_usuario' => $request->id_usuario,
            'mensaje' => $request->mensaje,
            'leido' => false,
            'fecha_envio' => now(),
        ]);

        return redirect()->route('admin.notificaciones.index')
            ->with('success', 'Notificación enviada exitosamente.');
    }

    /**
     * Envía una notificación a todos los usuarios de un rol específico.
     */
    public function enviarMasiva(Request $request)
    {
        $request->validate([
            'id_rol' => 'required|exists:roles,id',
            'mensaje' => 'required|string',
        ]);

        $usuarios = User::where('id_rol', $request->id_rol)->get();
        
        foreach ($usuarios as $usuario) {
            Notificacion::create([
                'id_usuario' => $usuario->id,
                'mensaje' => $request->mensaje,
                'leido' => false,
                'fecha_envio' => now(),
            ]);
        }

        return redirect()->route('admin.notificaciones.index')
            ->with('success', 'Notificaciones masivas enviadas exitosamente.');
    }

    /**
     * Marca una notificación como leída.
     */
    public function marcarLeida(Notificacion $notificacion)
    {
        // Verificar que la notificación pertenezca al usuario autenticado
        if ($notificacion->id_usuario != Auth::id()) {
            return redirect()->route('notificaciones.index')
                ->with('error', 'No tienes permiso para acceder a esta notificación.');
        }
        
        $notificacion->leido = true;
        $notificacion->save();

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación marcada como leída.');
    }

    /**
     * Marca todas las notificaciones del usuario como leídas.
     */
    public function marcarTodasLeidas()
    {
        Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->update(['leido' => true]);

        return redirect()->route('notificaciones.index')
            ->with('success', 'Todas las notificaciones han sido marcadas como leídas.');
    }

    /**
     * Muestra todas las notificaciones (vista de administrador).
     */
    public function adminIndex()
    {
        $notificaciones = Notificacion::with('usuario')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.notificaciones.index', compact('notificaciones'));
    }

    /**
     * Elimina una notificación específica.
     */
    public function destroy(Notificacion $notificacion)
    {
        // Verificar que la notificación pertenezca al usuario autenticado o sea admin
        if ($notificacion->id_usuario != Auth::id() && Auth::user()->id_rol != 1) {
            return redirect()->route('notificaciones.index')
                ->with('error', 'No tienes permiso para eliminar esta notificación.');
        }
        
        $notificacion->delete();

        return redirect()->back()
            ->with('success', 'Notificación eliminada exitosamente.');
    }
}