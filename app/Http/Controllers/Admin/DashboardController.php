<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'seller' => User::where('roles', 'SELLER')->count(),
            'user' => User::where('roles', 'USER')->count()
        ]);
    }
}
