<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sliders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlidersRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
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
            $query = Sliders::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-2">
                            <a href="' . route('sliders.edit', $item->id) . '" class="btn btn-secondary mr-2">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <form action="' . route('sliders.destroy', $item->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="max-height: 40px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }
        $slider = Sliders::all();
        return view('pages.admin.slider.index', compact('slider'));
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
        if ($data) {
            Alert::success('Berhasil!', 'Slider ' . $request->name . ' Berhasil Ditambahkan');
            return redirect()->route('sliders.index');
        } else {
            Alert::error('Gagal!', 'Slider ' . $request->name . ' Gagal Ditambahkan');
            return redirect()->route('sliders.index');
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
        $slider = Sliders::findOrFail($id);
        $file_photo = $request->file('photo');

        if ($file_photo) {
            $data['photo'] = $file_photo->store('assets/sliders', 'public');
        } else {
            unset($data['photo']);
        }
        
        $slider->update($data);

        if ($data) {
            Alert::success('Berhasil!', 'Slider ' . $request->name . ' Berhasil Diubah');
            return redirect()->route('sliders.index');
        } else {
            Alert::error('Gagal!', 'Slider ' . $request->name . ' Gagal Diubah');
            return redirect()->route('sliders.edit');
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
