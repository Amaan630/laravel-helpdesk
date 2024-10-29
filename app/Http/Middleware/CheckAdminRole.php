<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->type === 'admin') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
