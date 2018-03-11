<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->role === 'user') {
            if ($request->ajax()) {
                return response('Forbidden', 403);
            }
            throw new AccessDeniedHttpException;
        }
        return $next($request);
    }
}