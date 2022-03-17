<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OpenStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('pages.customer.open-store.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpenStoreRequest $request)
    {
        $data = $request->all();
        $data['photo_profile'] = $request->file('photo_profile')->store(
            'assets/profile',
            'public'
        );
        $data['photo_shop'] = $request->file('photo_shop')->store(
            'assets/store',
            'public'
        );

        User::create($data);
        if ($data) {
            Alert::success('Berhasil!', 'Data Berhasil Dikirim!');
            return redirect()->route('dashboard-customer.index');
        }else{
            Alert::error('Gagal!', 'Data Gagal Dikirim!');
            return redirect()->route('dashboard-customer.index');
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
        $open = User::findOrFail($id);
        return view('pages.member.open', [
            'open' => $open
        ]);
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
        $data = $request->all();
        $data['photo_profile'] = $request->file('photo_profile')->store(
            'assets/profile',
            'public'
        );
        $data['photo_shop'] = $request->file('photo_shop')->store(
            'assets/store',
            'public'
        );
        $open = User::findOrFail($id);

        $open->update($data);

        if ($data) {
            Alert::success('Berhasil!', 'Data Berhasil Dikirim!');
            return redirect()->route('dashboard-customer');
        }else{
            Alert::error('Gagal!', 'Data Gagal Dikirim!');
            return redirect()->route('dashboard-customer.edit');
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
        //
    }
}
