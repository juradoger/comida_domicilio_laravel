<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Obtener el nombre del rol del usuario
        $rolUsuario = $user->rol->nombre;
        
        foreach ($roles as $role) {
            // Si el rol del usuario coincide con alguno de los roles permitidos
            if ($rolUsuario === $role) {
                return $next($request);
            }
        }
        
        // Si el usuario no tiene ninguno de los roles permitidos
        return redirect('/')
            ->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}