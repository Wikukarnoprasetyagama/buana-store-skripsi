<?php

namespace App\Http\Controllers\Member;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::where('users_id', Auth::user()->id)->get();
        return view('pages.member.product.index', [
            'products' => $product,
        ], compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.member.product.create', [
            'categories' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->name_product);
        $data['code'] = 'BSTORE-'. mt_rand(000000,999999);
        $product = Products::create($data);
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $path = $file->store('assets/product', 'public');

                $product_galleries = new ProductGallery();
                $product_galleries->products_id =$product['id'];
                $product_galleries->photo = $path;
                $product_galleries->save();

            }
        }
        if ($data) {
            Alert::success('Berhasil!', 'Produk Berhasil Ditambahkan!');
            return redirect()->route('products-seller.index');
        }else{
            Alert::error('Gagal!', 'Produk Gagal Ditambahkan!');
            return redirect()->route('products-seller.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Products::findOrFail($id);
        $gallery = ProductGallery::all()->where('products_id', Auth::user()->id)->get($id);
        $category = Category::all();
        return view('pages.member.product.edit', [
            'products' => $products,
            'categories' => $category,
            'galleries' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name_product);
        $product = Products::findOrFail($id);
        $product->update($data);
        if ($request->has('discount') == 0) {
            $data['discount_amount'] = 0;
        }
        if ($data) {
            Alert::success('Berhasil!', 'Produk ' . $request->name_product . ' Berhasil Diubah');
            return redirect()->route('products-seller.index');
        }else{
            Alert::error('Gagal!', 'Produk ' . $request->name_product . ' Gagal Diubah');
            return redirect()->route('products-seller.edit');
        }
        return redirect()->route('products-seller.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Products::class, 'slug', $request->name_product);
        return response()->json(['slug' => $slug]);
    }

    public function uploadGallery(Request $request)
    {
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $path = $file->store('assets/product', 'public');
                $product_galleries = new ProductGallery();
                $product_galleries->products_id = $request->products_id;
                $product_galleries->photo = $path;
                $product_galleries->save();

            }
        }
        return redirect()->route('gallery-product', $request->products_id)->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('gallery-product', $item->products_id)->with('success', 'Data berhasil diubah');
    }
}
