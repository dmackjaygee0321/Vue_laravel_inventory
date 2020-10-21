<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class checkupdatecategory
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
        
        $count = DB::table('categories')->where('id','!=' ,$id)->where('category','=' ,$request->input("category"))->count();
        if($count != 0)
        {
            return response()->json("Category is already exist");
        }
        
        return $next($request);
    }
}
