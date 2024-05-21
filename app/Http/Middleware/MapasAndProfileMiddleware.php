<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MapasAndProfileMiddleware
{
    public function handle($request, Closure $next)
    {
        $allowedUserIds = [1, 2, 3]; // Admin (1), Vendedor (2), Cliente (3)
        $user = auth()->user();

        if ($user && in_array($user->id, $allowedUserIds)) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}
