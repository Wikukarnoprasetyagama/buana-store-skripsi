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
        $slider = Sliders::all();
        return view('pages.admin.slider.index', [
            'sliders' => $slider
        ], compact('slider'));
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
        }else{
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

        if($file_photo) //jika foto tidak di update
        {
            $filename = $file_photo->getClientOriginalName();
            $data['photo'] = $filename;
            $data['photo'] = $request->file('photo')->store(
                'assets/slider',
                'public'
            );
            $proses = $file_photo->move('assets/slider', 'public');
        } 
        $slider->update($data);

        if ($data) {
            Alert::success('Berhasil!', 'Slider ' . $request->name . ' Berhasil Diubah');
            return redirect()->route('sliders.index');
        }else{
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
