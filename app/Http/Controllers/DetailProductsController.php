<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\countOf;

class DetailProductsController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $product = Products::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        $cart = Cart::all();
        return view('detail', [
            'products' => $product,
            'carts' => $cart,
        ]);
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
            'quantity' => $request->quantity
        ];

        
        $cart = Cart::where(['products_id' => $data], ['deleted_at' => $data], Auth::user()->id)->count();
        if ($cart > 0) {
            Alert::warning('Gagal!', 'Produk sudah ada di keranjang!');
            return redirect()->route('cart');
        }else{
            Cart::create($data);
            Alert::success('Berhasil Ditambahkan!', 'Produk yang anda pilih berhasil ditambahkan ke keranjang.');
            return redirect()->route('cart');
        }
    }
}
