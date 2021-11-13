<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSellerController extends Controller
{
    public function index()
    {
        return view('pages.seller.dashboard');
    }
}
