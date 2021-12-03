<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seller\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $category = Category::all();
        return view('home', [
            'categories' => $category
        ]);
    }
}
