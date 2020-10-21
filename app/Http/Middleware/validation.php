<?php

namespace App\Http\Middleware;

use Closure;

class validation
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
        if(!$request->session()->has('name'))
        {
            return redirect("/");
        }
        return $next($request);
    }
}
