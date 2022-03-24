<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // $code = $request->code_unique;
        // $payment = Transaction::where('users_id', Auth::user()->id)->firstOrFail();
        // $transaction = Transaction::with(['product', 'user'])->where('users_id', Auth::id())->firstOrFail();
        // $transaction = Transaction::with(['product', 'user'])->firstOrFail();
        // $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
        //         ->whereHas('transaction', function($product){
        //             $product->where('users_id', Auth::user()->id);
        //         })->get();
        // $total = $transaction->get()->reduce(function($carry, $item) {
        //     return $carry + $item->total_price + $item->code_unique;
        // });
        // dd($transaction);
        $transactions = TransactionDetail::all()->last();
        return view('transaction', [
            'transactions' => $transactions,
        ], compact('transactions'));
    }
}
