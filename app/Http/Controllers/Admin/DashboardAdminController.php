<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $products = Products::where('users_id', Auth::user()->id)->count();
        $category = Category::count();
        $slider = Sliders::count();
        $transactions = Transaction::where('payment_status', 'DIBAYAR');
        $profit = $transactions->get()->reduce(function($carry, $item) {
            return $carry + $item->code_unique;
        });
        return view('pages.admin.dashboard', [
            'seller' => User::where('roles', 'SELLER')->count(),
            'user' => User::where('roles', 'CUSTOMER')->count(),
            'open_store' => User::where('status', 'PENDING')->get()->count(),
            'products' => $products,
            'category' => $category,
            'sliders' => $slider,
            'transactions' => $transactions,
            'profit' => $profit,
        ]);
    }
}
