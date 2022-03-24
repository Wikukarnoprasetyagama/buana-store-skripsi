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
        // $order = Transaction::whereHas('product', function($product) {
        //     $product->where('users_id', auth()->id());
        // })->orderBy('created_at', 'asc')->take(5)->get();
        $order = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('product', function($transaction) {
                            $transaction->where('users_id', Auth::user()->id);
                        })->orderBy('created_at', 'asc')->take(5)->get();
        $invoices = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('transaction', function($transaction) {
                            $transaction->where('users_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->take(5)->get();
        $product = Products::where('users_id', Auth::user()->id)->count();
        $cart = Cart::where('users_id', Auth::user()->id)->count();
        $transaction = Transaction::where('users_id', Auth::user()->id);
        $profit = Transaction::where('payment_status', 'DIBAYAR')->sum('total_price');
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
        ]);
    }
}
