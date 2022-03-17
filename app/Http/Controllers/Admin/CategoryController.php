<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('pages.admin.category.index', [
            'categories' => $category
        ], compact('category')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name_category);
        $data['photo'] = $request->file('photo')->store(
            'assets/category', 'public'
        );
        Category::create($data);
        if ($data) {
            Alert::success('Berhasil!', 'Kategori Berhasil Ditambahkan.');
            return redirect()->route('category.index');
        }else{
            Alert::error('Gagal!', 'Kategori Gagal Ditambahkan.');
            return redirect()->route('category.index');
        }
        // return redirect()->route('category.index')->with('success', 'Kategori Berhasil Ditambahkan!');
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
        $category = Category::findOrFail($id);

        return view('pages.admin.category.edit', [
            'category' => $category
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name_category);

        $category = Category::findOrFail($id);

        $file_photo = $request->file('photo');

        if($file_photo) //jika foto tidak di update
        {
            $filename = $file_photo->getClientOriginalName();
            $data['photo'] = $filename;
            $data['photo'] = $request->file('photo')->store(
                'assets/category',
                'public'
            );
            $proses = $file_photo->move('assets/category', 'public');
        } 

        $category->update($data);

        if ($data) {
            Alert::success('Berhasil!', 'Kategori Berhasil Diubah.');
            return redirect()->route('category.index');
        }else{
            Alert::error('Gagal!', 'Kategori Gagal Diubah.');
            return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
