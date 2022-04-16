<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Mail;

class ProductController extends Controller
{
    // all products
    public function index(Request $request)
    {
        $search_by_product_name = $request->search_by_product_name;
        $search_by_author_name  = $request->search_by_author_name;
        $search_by_date         = $request->search_by_date;

        if ($search_by_product_name || $search_by_author_name || $search_by_date) {
            if ($search_by_product_name) {
                $query = Product::where('product_name', 'LIKE', "%{$search_by_product_name}%");
            }
    
            if ($search_by_author_name) {
                $query = Product::where('author_name', 'LIKE', "%{$search_by_author_name}%");
            }
    
            if ($search_by_date) {
                $query = Product::where('created_at', 'LIKE', "%{$search_by_date}%");
            }

            $products = $query->latest()->paginate(10);
        } else {
            $products = Product::latest()->paginate(10);
        }
        return response()->json($products, 200);
    }
}
