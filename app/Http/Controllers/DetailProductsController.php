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
        
        // $data = [
        //     'products_id' => $id,
        //     'users_id' => Auth::user()->id,
        // ];

        

        // Cart::Create($data);
        $product_id = $request->input('products_id');
        $product_qty = $request->input('quantity');
        if (Auth::check()) {
            $prod_check = Products::where('id', $product_id)->first();

            if ($prod_check) {
                if(Cart::where('products_id', $product_id)->where('users_id', Auth::id())->exists())
                {
                    return response()->json(['status' => $prod_check->name. "Already Added to cart"]);
                }
                $cartItem = new Cart;
                $cartItem->products_id = $product_id;
                $cartItem->users_id = Auth::user()->id;
                $cartItem->quantity = $product_qty;
                $cartItem->save();
                return response()->json(['status' => $prod_check->name. "Add to Cart"]);
                return redirect()->route('cart');
            }
        }else{
            return response()->json(['status' => "Login to Continue"]);
        }
        return redirect()->route('cart');
        
    }
}
