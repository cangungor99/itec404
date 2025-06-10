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

        if (! $user->hasAnyRole($roles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
