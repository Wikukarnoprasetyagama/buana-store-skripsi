<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        $store = Store::all();
        return view('pages.customer.dashboard', [
            'name_store' => $store 
        ]);
    }
}
