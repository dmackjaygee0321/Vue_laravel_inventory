<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class checkproducts
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
        /*
        $count = DB::table('products')->where('product', $request->input("pname"))->count();
        if($count != 0)
        {
            return response()->json("Product is already exist");
        }
        */
        return $next($request);
    }
}
