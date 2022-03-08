<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\countOf;

class DetailProductsController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $product = Products::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        $cart = Cart::all();
        return view('detail', [
            'products' => $product,
            'carts' => $cart,
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
            'quantity' => $request->quantity,
        ];

        Cart::create($data);
        return redirect()->route('cart');
    }
}
