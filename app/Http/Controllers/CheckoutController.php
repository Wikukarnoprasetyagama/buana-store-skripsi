<?php

namespace App\Http\Controllers;

use Midtrans;
use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;

use App\Models\Products;

use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi midtrans
    Config::$serverKey = config('services.midtrans.serverKey');
    Config::$isProduction = config('services.midtrans.isProduction');
    Config::$isSanitized = config('services.midtrans.isSanitized');
    Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function process(Request $request, Transaction $transaction)
    {


        // save user data
        // $user = Auth::user();
        // $user->update($request->except('total_price'));

        $data = $request->all();
        $data['users_id'] = Auth::id();
        $data['products_id'] = $request->products_id;
        // $data['id'] = 'TRX-' . mt_rand(000000, 999999);

        // update user data
        // $user = Auth::user();
        // $user->name = $data['name'];
        // $user->occupation = $data['occupation'];
        // $user->phone = $data['phone'];
        // $user->address = $data['address'];
        // $user->save();

        // create checkout
        $transaction = Transaction::create([
            'users_id' => Auth::id(),
            'products_id' => $request->products_id,
            'total_price' => $request->total_price,
            'code_product' => $request->code,
            'quantity' => $request->quantity,
            'name' => $request->name,
            'phone' => $request->phone,
            'street' => $request->street,
            'village' => $request->village,
            'address' => $request->address,
            'code_unique' => $request->code_unique,
        ], $data);
        $this->getSnapRedirect($transaction);




        // create transaction
        // $transaction = Transaction::create([
        //     'code_product' => $request->code_product,
        // ]);

        

        // delete cart
        Cart::with('product', 'user')
                ->where('users_id', Auth::user()->id)
                ->delete();
        return view('checkout-success');
    }

    public function getSnapRedirect(Transaction $transaction)
    {
        Transaction::with('product', 'user')
                ->where('users_id', Auth::user()->id)->get();
                
        // $orderId = $transaction->id.'-'.Str::random(5);
        $orderId = $transaction->id. '-' . Str::random(5);
        $price = $transaction->total_price;

        $transaction->order_id = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Pembayaran {$transaction->product->name_product}"
        ];

        $customer_details = [
            "first_name" => Auth::user()->name,
            "last_name" => "",
            "email" => Auth::user()->email,
            "phone" => Auth::user()->phone,
            "billing_address" => "",
            "shipping_address" => "",
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();
            return view('success', $paymentUrl) ;
        } catch (Exception $e) {
            return false;
        }
    }


    public function callback(Request $request)
    {
        
        $notif = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $transaction_id = explode('-', $notif->order_id)[0];
        $transaction = Transaction::find($transaction_id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->payment_status = 'PENDING';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->payment_status = 'DIBAYAR';
            }
        }
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'FAILED';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->payment_status = 'FAILED';
            }
        }
        else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->payment_status = 'FAILED';
        }
        else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaction->payment_status = 'DIBAYAR';
        }
        else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaction->payment_status = 'PENDING';
        }
        else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaction->payment_status = 'FAILED';
        }

        $transaction->save();
        return view('success');
    }
}
