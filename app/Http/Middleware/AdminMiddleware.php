<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // Verifica si el usuario es un administrador (tipo_usuario = 1)
        if ($user && $user->tipo_usuario == 1) {
            return $next($request);
        }

        // Si no es un administrador, redirige a una página no autorizada o realiza otra acción.
        return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}