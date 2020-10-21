<?php

namespace App\Http\Middleware;

use Closure;

class refreshsession
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
        if($request->session()->has('name'))
        {
            return response()->json("/");
        }   
        return $next($request);
    }
}
