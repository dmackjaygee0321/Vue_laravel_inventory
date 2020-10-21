<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class checkexist
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
        $count = DB::table('accounts')->where('email', $request->input("email"))->count();
        $count1 = DB::table('accounts')->where('uname', $request->input("uname"))->count();
        if($count1 != 0 && $count != 0)
        {
            return response()->json("Account is already exist");
        }
        else if($count!= 0)
        {
            return response()->json("Email is already exist");
        }
        else if($count1 != 0)
        {
            return response()->json("Username is already exist");
        }
        return $next($request);
    }
}
