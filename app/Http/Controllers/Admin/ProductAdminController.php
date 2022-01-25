<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGallery;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Products::with(['category', 'user'])->where('users_id', auth()->id())->get();

            return DataTables::of($query)
                    ->addColumn('action', function($item){
                        return '
                        <div class="action">
                        <a href="' . route('products-admin.edit', $item->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                        <a href="#" data-url="'. route('products-admin.destroy', $item->id) . '" data-id="' .$item->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make();
        }

        $item = Products::where('users_id', auth()->id())->get();
        return view('pages.admin.product.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.admin.product.create', [
            'categories' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $data['slug'] = Str::slug($request->name_product); 
        $product = Products::create($data);
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $path = $file->store('assets/product', 'public');

                $product_galleries = new ProductGallery;
                $product_galleries->products_id =$product['id'];
                $product_galleries->photo = $path;
                $product_galleries->save();

            }
        }
        return redirect()->route('products-admin.index')->with('success', 'Data Berhasil Ditambahkan!');

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
        $product = Products::findOrFail($id);
        $category = Category::all();
        return view('pages.admin.category.edit', [
            'product' => $product,
            'categories' => $category,
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
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        $product = Products::findOrFail($id);

        $product->update($data);

        if ($data) {
            return redirect()->route('products-admin.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('products-admin.edit')->with('error', 'data gagal diubah');
        }
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

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('products-admin.create');

    }
}
