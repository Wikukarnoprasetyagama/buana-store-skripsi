<?php

namespace App\Http\Controllers;

use App\Models\ProductGallery;
use App\Models\Products;
use Illuminate\Http\Request;

class DetailProductsController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $product = Products::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view('detail', [
            'products' => $product
        ]);
    }
}
