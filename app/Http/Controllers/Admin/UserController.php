<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::where('roles', 'USER');

            return DataTables::of($query)
                    ->addColumn('action', function($user){
                        return '
                        <div class="action">
                        <a href="' . route('sliders.edit', $user->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                        <a href="#" data-url="'. route('sliders.destroy', $user->id) . '" data-id="' .$user->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        ';
                    })
                    ->editColumn('photo', function($user){
                        return $user->photo ? '<img src="'. Storage::url($user->photo).'" style="max-height: 30px;" />' : '';
                    })
                    ->rawColumns(['action', 'photo'])
                    ->make();
        }
        return view('pages.admin.seller.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
