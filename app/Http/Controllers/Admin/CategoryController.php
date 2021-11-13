<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        if (request()->ajax()) {
            $query = Category::all();

            return DataTables::of($query)
                    ->addColumn('action', function($slider){
                        return '
                        <div class="action">
                        <a href="' . route('sliders.edit', $slider->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                        <a href="#" data-url="'. route('sliders.destroy', $slider->id) . '" data-id="' .$slider->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        ';
                    })
                    ->editColumn('photo', function($slider){
                        return $slider->photo ? '<img src="'. Storage::url($slider->photo).'" style="max-height: 30px;" />' : '';
                    })
                    ->rawColumns(['action', 'photo'])
                    ->make();
        }
        return view('pages.admin.category.index');
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
        $data['photo'] = $request->file('photo')->store(
            'assets/category', 'public'
        );
        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Data Berhasil Ditambahkan!');
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
        $data['photo'] = $request->file('photo')->store(
            'assets/category', 'public'
        ); 

        $category = Category::findOrFail($id);

        $category->update($data);

        if ($data) {
            return redirect()->route('category.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('category.edit')->with('error', 'data gagal diubah');
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
