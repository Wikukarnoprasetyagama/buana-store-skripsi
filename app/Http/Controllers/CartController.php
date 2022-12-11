<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\District;
use App\Models\TransactionDetail;
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
        $carts = Cart::with(['product.galleries', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();
        $product = Cart::all();
        $district = District::where('id', 1406042)->get();
        $village = Village::where('district_id', 1406042)->get();
        $notes = TransactionDetail::where('transactions_id', Auth::user()->id)->get();
        // $fee = $carts->reduce(function($carry, $item) {
        //     return $carry + $item->product->discount_amount;
        // });
        // dd($fee);
        $ongkir = $carts->reduce(function ($carry, $item) {
            // if ($item->product->ongkir == true) {
            return $carry + $item->product->ongkir_amount;
            // }else{
            //     return $carry;
            // }
        });
        // $discount = (($total * $cart->quantity * $cart->product->discount_amount) / 100);
        $discount = $product->reduce(function ($carry, $item) {
            return $carry + (($item->product->price * $item->quantity * $item->product->discount_amount) / 100);
        });
        $total = $carts->reduce(function ($carry, $item) {
            return $carry + $item->product->price * $item->quantity + $item->product->ongkir_amount;
            // var_dump($discount);
        });
        // dd($total);
        return view('cart', [
            'carts' => $carts,
            'code_unique' => $code_unique,
            // 'fee' => $fee,
            'villages' => $village,
            'ongkir' => $ongkir,
            'totals' => $total,
            'discounts' => $discount,
            'notes' => $notes,
            'districts' => $district,
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
            $cart->update(['quantity' => $data['qty']], $data);
            return response()->json('data berhasil diubah!');
            // return response()->json(['view' => (String) View::make('cart', compact('carts'))]);
        }

        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            // $cart = Cart::firstOrFail($id);
            // $cart->update($data);
            return response()->json('berhasil diubah');
        }
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            Cart::userCartItems();
            return response()->json('Data berhasil diubah!');
        }
    }

    // public function payout()
    // {
    //     $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
    //     return view('checkout', [
    //         'carts' => $carts
    //     ]);
    // }

}
