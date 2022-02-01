<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Seller\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function index()
    {
        $product = Products::all()->where('users_id', auth()->id())->count();
        $transaction = TransactionDetail::where('products_id', auth()->id())->get()->count();
        return view('pages.member.dashboard', [
            'product' => $product,
            'transaction' => $transaction,
        ]);
    }
}
