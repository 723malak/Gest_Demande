<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ChefProjetMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->Profil === 'ChefProjet') {
            return $next($request);
        }

        abort(403, "Accès refusé.");
    }
}
