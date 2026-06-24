<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        {
            if(!auth()->check || !auth()->user()->is_admin){
                abort(403,'akses ditolak halaman ini khusus admin');
            }
        }
        return $next($request);
    }
}
