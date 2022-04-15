<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $item = User::count();

        $product = Products::where('users_id', Auth::user()->id)->count();

        $cart = Cart::where('users_id', Auth::user()->id)->count();

        $transaction = Transaction::where('users_id', Auth::user()->id);

        $order = TransactionDetail::with(['transaction.user', 'product.galleries'])
                    ->whereHas('product', function($transaction) {
                        $transaction->where('users_id', Auth::user()->id);
                    })->orderBy('created_at', 'desc')->take(5)->get();

        $invoices = TransactionDetail::with(['transaction.user', 'product.galleries'])
                    ->whereHas('transaction', function($transaction) {
                        $transaction->where('users_id', Auth::user()->id);
                    })->orderBy('created_at', 'desc')->take(5)->get();

        $profit = TransactionDetail::with('transaction:id,total_price,payment_status')
                    ->whereHas('product', function($product) {
                        $product->where('users_id', Auth::user()->id);
                    })->whereHas('transaction', function($transaction){
                        $transaction->where('payment_status', 'DIBAYAR');
                    })->get()->reduce(function($carry, $item) {
                        return $carry + $item->transaction->total_price ;
                    });
        
        $revenue = $transaction->get()->reduce(function($carry, $item) {
            return $carry + $item->total_price + $item->admin_fee + $item->code_unique;
        });
        return view('pages.member.dashboard', [
            'item' => $item,
            'product' => $product,
            'cart' => $cart,
            'transaction' => $transaction->count(),
            'revenue' => $revenue,
            'invoices' => $invoices,
            'orders' => $order,
            'profit' => $profit,
        ], compact('invoices'));
    }
}
