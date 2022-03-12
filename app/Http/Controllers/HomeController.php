<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Products::all();
        $brand = Sliders::all();
        return view('home', [
            'categories' => $category,
            'products' => $product,
            'brands' => $brand
        ]);
    }
    public function navbar()
    {
        $user = User::all();
        return view('includes.navbar', [
            'users' => $user
        ]);
    }
}
