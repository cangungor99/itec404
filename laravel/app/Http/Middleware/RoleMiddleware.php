<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (! $user = $request->user()) {
            return $next($request);
        }

        // $roles artık ['student','leader'] veya ['admin']
        if (! $user->hasAnyRole($roles)) {
            abort(403, 'Yetkiniz yok.');
        }

        return $next($request);
    }
}
