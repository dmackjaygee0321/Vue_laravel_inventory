<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\validation;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware("sessionout");


Route::get('/home', function()
{
    return view('home');
})->middleware("validation");

Route::get('/logout', function(Request $request)
{
    $request->session()->forget('name');
    return redirect("/");
});

Route::get('{any}', function () {
    return redirect("/");
})->middleware("sessionout");






Route::post('/login', 'AccountController@login');

