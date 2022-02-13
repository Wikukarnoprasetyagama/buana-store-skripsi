<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionsController extends Controller
{
    public function index()
    {
        $transaction = Transaction::with(['product', 'user'])->get();
        return view('pages.admin.transaction.customer', [
            'transactions' => $transaction,
        ]);
    }
}
