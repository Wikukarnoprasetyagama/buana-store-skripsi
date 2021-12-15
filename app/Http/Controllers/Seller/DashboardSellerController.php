<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Seller\Product;
use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function index()
    {
        $product = Products::all()->where('users_id', auth()->id())->count();
        return view('pages.seller.dashboard', [
            'product' => $product
        ]);
    }
}
