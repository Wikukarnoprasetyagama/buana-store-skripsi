<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\Slider;
use App\Models\Sliders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $products = Products::where('users_id', Auth::user()->id)->count();
        $category = Category::count();
        $slider = Sliders::count();
        return view('pages.admin.dashboard', [
            'seller' => User::where('roles', 'SELLER')->count(),
            'user' => User::where('roles', 'USER')->count(),
            'products' => $products,
            'category' => $category,
            'sliders' => $slider
        ]);
    }
}
