<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller\Product;
use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function index()
    {
        $product = Product::all()->count();
        return view('pages.seller.dashboard', [
            'product' => $product
        ]);
    }
}
