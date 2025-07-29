<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        $user = Auth::user();

        // Verificar que el usuario sea cliente (rol 3)
        if ($user->id_rol !== 3) {
            // Si es empleado (rol 2), redirigir al panel de empleados
            if ($user->id_rol === 2) {
                return redirect('/empleado')->with('warning', '⚠️ Ya no tienes acceso al panel de clientes. Has sido convertido a empleado. Bienvenido al panel de empleados.');
            }
            
            // Si es admin (rol 1), redirigir al panel de administración
            if ($user->id_rol === 1) {
                return redirect('/admin')->with('warning', '⚠️ Los administradores no tienen acceso al panel de clientes.');
            }
            
            // Para cualquier otro rol, redirigir a la página principal
            return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
} 