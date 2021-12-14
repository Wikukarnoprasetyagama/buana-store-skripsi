<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        $detail = UserDetails::all();
        return view('pages.customer.dashboard', [
            'details' => $detail
        ]);
    }
}
