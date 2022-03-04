<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function index()
    {
        $code_unique = mt_rand(500, 999);
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $district = Districts::all();
        return view('cart', [
            'carts' => $carts,
            'districts' => $district,
            'code_unique' => $code_unique
        ], compact('carts'));
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart');
    }

    // public function updateCart(Request $request, $id)
    // {
    //     $data = $request->quantity;
    //     $quantity = Cart::findOrFail($id);
    //     $quantity->update($data);
    // }

    public function success()
    {
        return view('success');
    }

    
    public function updateQuantity(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $cart = Cart::where('id', $data['cartid']);
            $cart->update(['quantity'=> $data['qty']], $data);
            return response()->json('data berhasil diubah!');
            // return response()->json(['view' => (String) View::make('cart', compact('carts'))]);
        }
        
        // if ($request->ajax()) {
        //     $data = $request->all();
        //     Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
        //     // $cart = Cart::firstOrFail($id);
        //     // $cart->update($data);
        //     return response()->json('berhasil diubah');
        // }
        // if ($request->ajax()) {
        //     $data = $request->all();
        //     Cart::where('id', $data['cartid'])->update(['quantity'=> $data['qty']]);
        //     Cart::userCartItems();
        //     return response()->json('Data berhasil diubah!');
        // }
    }

    // public function payout()
    // {
    //     $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
    //     return view('checkout', [
    //         'carts' => $carts
    //     ]);
    // }
    
}
