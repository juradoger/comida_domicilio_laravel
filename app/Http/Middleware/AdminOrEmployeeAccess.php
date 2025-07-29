<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrEmployeeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect('/login');
        }

        // Verificar si el usuario tiene rol de administrador (id = 1) o empleado (id = 2)
        if ($user->id_rol !== 1 && $user->id_rol !== 2) {
            abort(403, 'No tienes acceso a este panel.');
        }

        return $next($request);
    }
} 