<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Products::all();
        return view('category', [
            'categories' => $category,
            'products' => $products
        ]);
    }
    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Products::with(['galleries'])->where('categories_id', $category->id)->Paginate(2);
        return view('detail-category', [
            'categories' => $categories,
            'products' => $products,
            'category' => $category
        ]);
    }
}
