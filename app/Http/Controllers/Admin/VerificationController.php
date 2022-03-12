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
        $member = User::where('status', 'PENDING')->get();
        return view('pages.admin.verifications.index', [
            'members' => $member,
        ], compact('member'));
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
        $detail = User::findOrFail($id);
        return view('pages.admin.verifications.detail', [
            'detail' => $detail,
            // 'user' => User::where('status', 'PENDING')->get()
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
        $detail = User::findOrFail($id);
        return view('pages.admin.verifications.detail', [
            'detail' => $detail,
            // 'user' => User::where('status', 'PENDING')->get()
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

        // $data = User::all();
        $data = $request->all();
        $verification = User::findOrFail($id);
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
