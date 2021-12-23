<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category', [
            'categories' => $category
        ]);
    }
}
