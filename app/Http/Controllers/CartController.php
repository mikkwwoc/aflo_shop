<?php

namespace App\Http\Controllers;

use App\CartElements\Cart;
use App\CartElements\CartItem;
use App\Models\Product;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.index', [
            'cart' => Session::get('cart', new Cart())
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product): JsonResponse
    {
        $cart = Session::get('cart', new Cart());

        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success'
            ]);
    }

    public function destroy(Product $product)
    {

        try{
            $cart = Session::get('cart', new Cart());
            Session::put('cart', $cart->removeItem($product));
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
