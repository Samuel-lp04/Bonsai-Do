<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Comprobamos si el usuario ha iniciado sesión y si su rol es 'admin'
        if (auth()->check() && auth()->user()->rol === 'admin') {
            // Si es admin, le abrimos la puerta y le dejamos continuar
            return $next($request);
        }

        // 2. Si no es admin (es cliente o no ha iniciado sesión), lo mandamos a la home
        return redirect('/home')->with('error', 'Acceso denegado. Solo para administradores.');
    }
}
