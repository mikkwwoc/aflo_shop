<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query('filter');
        $query = Product::query();
        if(!is_null($filters)) {
            if(array_key_exists('categories', $filters)){
                $query = $query->whereIn('category_id', $filters['categories']);
            }
            if(!is_null($filters['price_min'])) {
                $query = $query->where('price', '>=', $filters['price_min']);
            }
            if(!is_null($filters['price_min'])) {
                $query = $query->where('price', '<=', $filters['price_max']);
            }

            return response()->json([
                'data' => $query->get()
            ]);
        }

        return view('welcome', [

            'products' => $query->paginate(20),
            'categories' => ProductCategory::orderBy('name', 'ASC')->get(),
        ]);
    }
}
