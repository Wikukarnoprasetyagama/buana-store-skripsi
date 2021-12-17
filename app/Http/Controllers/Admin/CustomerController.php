<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::where('roles', 'CUSTOMER');

            return DataTables::of($query)
                    ->addColumn('action', function($user){
                        return '
                        <div class="action">
                        <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                        type="button" 
                                        data-toggle="dropdown">
                                        Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                        <a href="' . route('customer.edit', $user->id) . '" class="dropdown-item">Sunting</a>
                                        <a href="#" data-url="'. route('sliders.destroy', $user->id) . '" data-id="' .$user->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus dropdown-item">Blokir</a>
                                        <form action="' . route('customer.update', $user->id) . '" class="" method="POST" enctype="multipart/form-data">
                                        '. method_field('PUT') . csrf_field() .'
                                        <input type="hidden" name="roles" value="SELLER">
                                        <button class="dropdown-item" type="submit">Jadikan Seller</button>
                                        </form>
                                        </div>
                                        </div>
                            </div>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make();
        }
        return view('pages.admin.customer.index');
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
        $change = User::findOrFail($id);
        return view('pages.admin.customer.index', [
            'change' => $change,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $data = $request->all();
        $seller = User::findOrFail($id);
        $seller->update($data);

        return redirect()->route('dashboard-admin');
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
