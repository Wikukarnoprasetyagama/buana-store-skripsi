<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Districts;
use App\Models\Products;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $code_unique = mt_rand(500, 999);
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $village = Village::all();
        $fee = $carts->reduce(function($carry, $item) {
            return $carry + $item->product->discount_amount;
        });
        $ongkir = $carts->reduce(function($carry, $item) {
            return $carry + $item->product->ongkir_amount;
        });
        return view('cart', [
            'carts' => $carts,
            'code_unique' => $code_unique,
            'fee' => $fee,
            'ongkir' => $ongkir,
            'villages' => $village
        ], compact('carts'));
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        
        if ($cart) {
            Alert::success('Berhasil Dihapus!', 'Produk berhasil dihapus dari keranjang.');
            return redirect()->route('cart');
        }
    }
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
