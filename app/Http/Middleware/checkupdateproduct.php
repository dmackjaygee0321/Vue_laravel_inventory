<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class checkupdateproduct
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
        $id = $request->route('id');
        
        $count = DB::table('products')->where('id','!=' ,$id)->where('product','=' ,$request->input("product"))->count();
        if($count != 0)
        {
            return response()->json("Product is already exist");
        }
        return $next($request);
    }
}
