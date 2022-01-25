<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

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

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Array yang di kirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customers_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enable_payments' => [
                'bank_transfer', 'indomaret', 'shopeepay'
            ],
            'vtweb' => []
        ];

        try{
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    return redirect()->route('success');
    }
}
