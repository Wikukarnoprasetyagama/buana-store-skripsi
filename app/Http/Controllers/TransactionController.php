<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // $code = $request->code_unique;
        $payment = Transaction::where('users_id', Auth::user()->id)->get();
        $transactions = Transaction::with(['product', 'user'])->where('users_id', Auth::id())->get();
        $total = $payment->reduce(function($carry, $item) {
            return $carry + $item->total_price + $item->code_unique;
        });
        return view('transaction', [
            'transactions' => $transactions,
        ], compact('transactions'));
    }
}
