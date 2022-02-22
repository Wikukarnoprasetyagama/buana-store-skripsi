<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Products::all();
        return view('home', [
            'categories' => $category,
            'products' => $product
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
