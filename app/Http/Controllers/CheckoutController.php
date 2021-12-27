<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // process checkout
        $code = 'BSTORE-' . mt_rand(000000,999999);
        $carts = Cart::with(['product', 'user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        // create transaction
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'total_price' => $request->total_price,
            'quantity' => $request->quantity,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);
            
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => $request->total_price,
                'resi' => 'PENDING',
                'code' => $trx
            ]);
        }

        // delete cart
        Cart::with('product', 'user')
                ->where('users_id', Auth::user()->id)
                ->delete();

    return redirect()->route('success');
    }
}
