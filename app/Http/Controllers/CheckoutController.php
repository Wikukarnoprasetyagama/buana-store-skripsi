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
        // $code = 'BSTORE-' . mt_rand(000000,999999);
        $carts = Cart::with(['product', 'user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        // create transaction
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'products_id' => $request->products_id,
            'shipping_price' => 0,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'payment_status' => 'Waiting',
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);
            
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'shipping_status' => 'Menunggu Konfirmasi',
                'code_transaction' => $trx,
                'name' => $request->name, 
                'phone' => $request->phone, 
                'street' => $request->street, 
                'village' => $request->village, 
                'address' => $request->address, 
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
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone
            ],
            'enabled_payments' => [
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
    }


    public function callback()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id; 

        // Cari transaksi berdasarkan id
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        elseif ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        }
        elseif ($status == 'pending') {
            $transaction->status = 'PENDING';
        }
        elseif ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        elseif ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        elseif ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();
    }
}
