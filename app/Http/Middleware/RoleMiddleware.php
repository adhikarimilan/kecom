<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleware
{ 
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(Auth::user()->role);
        if(Auth::check() && Auth::user()->role!=null && Auth::user()->role->name=="Admin")
        return $next($request);
        abort(404);
    }
}
