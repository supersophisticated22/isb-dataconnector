<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveSaasTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        // Tenant token auth will plug in here by reading the SaaS API/session token
        // and hydrating the tenant context before Filament handles the request.
        return $next($request);
    }
}
