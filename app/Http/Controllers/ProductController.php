<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$category = DB::table('products')->orderBy('id','desc')->get()->toArray();
        $category = DB::select('select a.*, b.category from products as a,categories b where a.cid = b.id order by a.id desc');
        return array_reverse($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new product([
            'product' => $request->input('pname'),
            'cid' => $request->input('cid'),
            'description' => $request->input('desc'),
            'quantity' => 0
        ]);
        $post->save();
        
        return response()->json('The Product successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        DB::table('products')
              ->where('id', $id)
              ->update(['product' => $request->input("product"),'description' => $request->input("description"),'cid' => $request->input("cid")]);
              
        return response()->json('The Product successfully updated');
    }

    public function inventory($id,Request $request)
    {
        DB::table('products')
              ->where('id', $id)
              ->update(['quantity' => $request->input("quantity")]);
              $pname = $request->input("product");
        return response()->json('Successfully Update Inventory ' . $pname);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = product::find($id);
        $post->delete();
 
        return response()->json('The Product successfully deleted');
    }
}
