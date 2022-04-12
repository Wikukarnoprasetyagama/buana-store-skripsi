<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // $code = $request->code_unique;
        // $payment = Transaction::where('users_id', Auth::user()->id)->firstOrFail();
        // $transaction = Transaction::with(['product', 'user'])->where('users_id', Auth::id())->firstOrFail();
        // $transaction = Transaction::with(['product', 'user'])->firstOrFail();
        // $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
        //         ->whereHas('transaction', function($product){
        //             $product->where('users_id', Auth::user()->id);
        //         })->get();
        // $total = $transaction->get()->reduce(function($carry, $item) {
        //     return $carry + $item->total_price + $item->code_unique;
        // });
        // dd($transaction);
        // $transaction = TransactionDetail::with(['transaction', 'product'])
        //                 ->whereHas('transaction', function($transaction) {
        //                     $transaction->where('users_id', Auth::user()->id);
        //                 })->get();
        $product = Cart::all();
        // $ongkir = $transaction->reduce(function($carry, $item) {
        //     if ($item->product->ongkir == true) {
        //         return $carry + $item->product->ongkir_amount;
        //     }else{
        //         return $carry;
        //     }
        // });
        // $discount = $product->reduce(function($carry, $item) {
        //     return $carry + (($item->product->price * $item->quantity * $item->product->discount_amount) / 100);
        // });
        $checkout = Transaction::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();
        $transaction = TransactionDetail::all();
        return view('transaction', [
            'transaction' => $transaction,
            // 'ongkir' => $ongkir,
            // 'discounts' => $discount,
            'checkouts' => $checkout,
        ]);
    }
}
