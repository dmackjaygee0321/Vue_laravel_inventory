<?php

namespace App\Http\Controllers;

use App\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = account::all()->toArray();
        return array_reverse($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        $post = new account([
            'email' => $request->input('email'),
            'uname' => $request->input('uname'),
            'password' => $request->input('password'),
        ]);
        $post->save();
        
        return response()->json('The Account successfully added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(account $account)
    {
        //
    }

    public function login(Request $request)
    {
        $count = DB::table('accounts')->where('email', $request->input("email"))->where('password', $request->input("password"))->count();
        if($count != 0)
        {  
            $results = DB::select("select id from accounts where email = ':user' && password = ':pass'", ['user' => $request->input("email"),'pass' => $request->input("password")]);
            $id = 0;
            foreach($results as $res)
            {
                $id = $res->id;
            }

            $request->session()->put('name',$id);
            return response()->json("Success");
        }
        return response()->json("incorrect Email or Passowrd");
    }
}
