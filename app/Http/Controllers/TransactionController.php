<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['product', 'user'])->where('users_id', Auth::id())->get();
        return view('transaction', [
            'transactions' => $transactions
        ]);
    }
}
