<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $item = User::count();
        // $order = Transaction::all()->where('products_id', auth()->id())->sortBy('created_at')->take(5);
        $order = Transaction::whereHas('product', function($product) {
            $product->where('users_id', auth()->id());
        })->orderBy('created_at', 'asc')->take(5)->get();
        $invoices = Transaction::all()->where('users_id', auth()->id())->take(5);
        $product = Products::all()->where('users_id', auth()->id())->count();
        $cart = Cart::all()->where('users_id', auth()->id())->count();
        $transaction = Transaction::where('users_id', Auth::user()->id);
        $profit = Transaction::where('payment_status', 'DIBAYAR')->whereHas('product', function($product){
            $product->where('users_id', auth()->id());
        })->sum('total_price');
        // $profit = Transaction::where('payment_status', 'DIBAYAR', auth()->id())->sum('total_price');
        $revenue = $transaction->get()->reduce(function($carry, $item) {
            return $carry + $item->total_price;
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
