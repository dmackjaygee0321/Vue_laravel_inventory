<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class checkcategory
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
        $count = DB::table('categories')->where('category', $request->input("cname"))->count();
        if($count != 0)
        {
            return response()->json("Category is already exist");
        }
        return $next($request);
    }
}
