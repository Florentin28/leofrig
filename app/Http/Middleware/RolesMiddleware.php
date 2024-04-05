<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolesMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Vérifiez si le rôle de l'utilisateur est autorisé à accéder à la route
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Redirigez l'utilisateur vers une page non autorisée s'il n'a pas le bon rôle
        switch (auth()->user()->role) {
            case 'admin':
                return redirect('/admin');
            case 'user':
                return redirect('/home');
            case 'consultation':
                return redirect('/consultation');
            default:
                return redirect('/login');
        }
    }
}
