<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function index()
    {
        $products = Products::latest()->filter(request(['search-product']))->paginate(20)->withQueryString();
        return view('all-product', [
            'products' => $products
        ], compact('products'));
    }
}
