<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("/addaccount","AccountController@create")->middleware("checkexist");
Route::get("/accounts","AccountController@index");


Route::post("/addcategory","CategoryController@store")->middleware("checkcategory");
Route::post("/updatecategory/{id}","CategoryController@update")->middleware("checkupdatecategory");
Route::delete('deletecategory/{id}', 'CategoryController@delete');
Route::get("/categories","CategoryController@index");


Route::post("/addproduct","ProductController@store")->middleware("checkproducts");
Route::post("/updateproduct/{id}","ProductController@update")->middleware("checkupdateproduct");
Route::post("/inventory/{id}","ProductController@inventory");
Route::delete('deleteproduct/{id}', 'ProductController@delete');

Route::get("/products","ProductController@index");

//Route::post("/login","AccountController@login");