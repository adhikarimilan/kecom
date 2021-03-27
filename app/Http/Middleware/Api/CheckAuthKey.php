<?php

namespace App\Http\Middleware\Api;

use Closure;

class CheckAuthKey
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
        $authkey=$request->header('authkey');
        if(!$authkey || $authkey!=env('API_AUTH'))
        return response()->json(['error'=>'You are not Authorized']);
        return $next($request);
    }
}
