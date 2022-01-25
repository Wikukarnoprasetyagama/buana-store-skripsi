<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sliders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlidersRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Sliders::all();

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
                        return $slider->photo ? '<img src="'. Storage::url($slider->photo).'" style="max-height: 50px;" />' : '';
                    })
                    ->rawColumns(['action', 'photo'])
                    ->make();
        }
        $item = Sliders::all();
        return view('pages.admin.slider.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlidersRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/sliders',
            'public'
        );

        Sliders::create($data);
        return redirect()->route('sliders.index')->with('success', 'Data Berhasil Ditambahkan!');
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
        $slider = Sliders::findOrFail($id);

        return view('pages.admin.slider.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlidersRequest $request, $id)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/slider',
            'public'
        );

        $slider = Sliders::findOrFail($id);

        $slider->update($data);

        if ($data) {
            return redirect()->route('sliders.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('sliders.edit')->with('error', 'data gagal diubah');
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
        $slider = Sliders::findOrFail($id);
        $slider->delete();
    }
}
