<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\CartElements\Cart;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $orders = Order::with('user')->paginate(10);

        return view('orders.index', [
            'orders' => $orders
        ]);

    }
    public function index_user(): View
    {

        return view('orders.indexuser', [
            'orders' => Order::where('user_id', Auth::id())->paginate(10)
        ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_delivered' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->is_delivered = $request->input('is_delivered');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Status zamówienia został zaktualizowany.');
    }
    public function edit(Order $order)
    {
        return view('orders.edit',[
            'order' => $order
        ]);
    }

    public function store()
    {
        $cart = Session::get('cart', new Cart());
        if ($cart->hasItems()) {
            $order = new Order();
            $order->quantity = $cart->getQuantity();
            $order->price = $cart->getTotalPrice();
            $order->user_id = Auth::id();
            $order->save();

            $productIds = $cart->getItems()->map(function ($item) {
                return ['product_id' => $item->getProductId()];
            });
            $order->products()->attach($productIds);


            Session::put('cart', new Cart());
            return redirect(route('orders.index'));
        }
        return back();
    }
}
