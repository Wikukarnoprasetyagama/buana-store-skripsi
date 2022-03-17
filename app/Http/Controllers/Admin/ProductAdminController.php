<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Products;
use App\Models\User;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('roles', 'SELLER')->get();
        return view('pages.admin.product.index',[
            'users' => $user
        ], compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        return abort(404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = User::findOrFail($id);
        $product = Products::all()->whereIn('users_id', $id);
        return view('pages.admin.product.detail', [
            'detail' => $detail,
            'products' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
        // $data = $request->all();
        // $data['slug'] = Str::slug($request->name);
        // $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        // $product = Products::findOrFail($id);

        // $product->update($data);

        // if ($data) {
        //     return redirect()->route('products-admin.index')->with('success', 'Data berhasil diubah');
        // } else {
        //     return redirect()->route('products-admin.edit')->with('error', 'data gagal diubah');
        // }
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

}
