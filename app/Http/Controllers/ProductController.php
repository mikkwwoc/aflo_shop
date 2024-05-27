<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', [

            'products' => Product::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description'  => $request->get('description'),
            'quantity'  => $request->get('quantity'),
            'image_path' => $request->file('image')->store('products')
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',[
        'product' => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        if($request->hasFile('image')){
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return response()->json([
                'status'=>'ok'
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'=>'error',
                'message'=>'Coś poszło nie tak.']) -> setStatusCode(500);
        }
    }
}
