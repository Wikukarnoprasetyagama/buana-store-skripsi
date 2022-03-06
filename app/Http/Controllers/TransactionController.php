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
        $payment = Transaction::all();
        $transactions = Transaction::with(['product', 'user'])->where('users_id', Auth::id())->get();
        // $total = $payment->reduce(function($carry, $item) {
        //     if ($item->code_unique == true || $item->code_unique == false) {
        //         return $carry + $item->total_price + $item->code_unique;
        //     }elseif ($item->code_unique == false) {
        //         return $carry + $item->total_price;
        //     }
        // });
        // dd($total);
        return view('transaction', [
            'transactions' => $transactions,
            // 'total' => $total,
            // 'code' => $code
        ], compact('transactions'));
    }
}
