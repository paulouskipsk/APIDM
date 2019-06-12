<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        return $next($request)
               ->header('Access-Controll-Allow-Origin', '*')
               ->header('Access-Controll-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
               ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');

    }
}
