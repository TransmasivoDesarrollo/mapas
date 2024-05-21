<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedUsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $allowedUserIds = [2, 3];
        $user = auth()->user();

        if ($user && in_array($user->id, $allowedUserIds)) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}
