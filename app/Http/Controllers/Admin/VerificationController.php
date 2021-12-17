<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\VerificationRequest;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = UserDetails::with(['user'])->where('status', 'PENDING')->get();

            return DataTables::of($query)
                    ->addColumn('action', function($item){
                        return '
                        <div class="action">
                        <a href="' . route('verification.edit',  $item->id) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                        <a href="#" data-url="'. route('verification.destroy', $item->id) . '" data-id="' .$item->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make();
        }
        $item = UserDetails::where('status', 'PENDING')->get();
        return view('pages.admin.verification.index', compact('item'));
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
        $detail = UserDetails::findOrFail($id);
        $user = UserDetails::with('user')->where('status', 'PENDING')->get()->take(1);
        return view('pages.admin.verification.detail', [
            'detail' => $detail,
            'users' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VerificationRequest $request, $id)
    {
        $data = $request->all();
        $verification = UserDetails::findOrFail($id);
        $verification->update($data);

        return redirect()->route('customer.index');
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
