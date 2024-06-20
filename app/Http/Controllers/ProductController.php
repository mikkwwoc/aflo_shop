<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use DB;

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
        return view('products.create', [
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->validated());
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('images', );
        }
        $product->save();

//        if($validated){
//            $product = Product::create([
//                'name' => $request->get('name'),
//                'price' => $request->get('price'),
//                'quantity'  => $request->get('quantity'),
//                'description'  => $request->get('description')
//            ]);
//            if($request->hasFile('image')){
//                $imagePath = $request->file('image')->store('products');
//                $product->update([
//                    'image_path' => $imagePath,
//                ]);
//            }
//        }

        return redirect()->route('products.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',[
            'product' => $product,
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',[
        'product' => $product,
            'categories' => ProductCategory::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
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
