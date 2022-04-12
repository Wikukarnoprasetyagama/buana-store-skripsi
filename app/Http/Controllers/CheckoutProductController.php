<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutProductController extends Controller
{
    public function index(Request $request)
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('transaction', function($transaction) {
                            $transaction->where('users_id', Auth::user()->id)->where('payment_status', 'MENUNGGU');
                        })->get();
        $product = Cart::all();
        $ongkir = $transactions->reduce(function($carry, $item) {
            if ($item->product->ongkir == true) {
                return $carry + $item->product->ongkir_amount;
            }else{
                return $carry;
            }
        });
        $discount = $product->reduce(function($carry, $item) {
            return $carry + (($item->product->price * $item->quantity * $item->product->discount_amount) / 100);
        });
        return view('checkout-product', [
            'transactions' => $transactions,
            'ongkir' => $ongkir,
            'discounts' => $discount,
        ], compact('transactions'));
    }
}
