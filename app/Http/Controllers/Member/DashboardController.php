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
    public function index()
    {
        $item = User::count();
        $invoices = Transaction::all()->where('users_id', auth()->id())->take(5);
        $product = Products::all()->where('users_id', auth()->id())->count();
        $cart = Cart::all()->where('users_id', auth()->id())->count();
        $transaction = Transaction::where('users_id', Auth::user()->id);
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
            // 'detail' => UserDetails::where('status', 'PENDING', Auth::user()->users_id)->get()
        ]);
    }
}
