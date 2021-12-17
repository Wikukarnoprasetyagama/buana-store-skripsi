<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenStoreRequest;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;

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

        // auth()->user()->name()->create(request([
        //     'photo_profile', 'name_store', 'phone', 'photo_shop', 'village', 'address'
        // ]));

        // $store = new User;
        // $store->photo_profile = $request->photo_profile;
        // $store->name_store = $request->name_store;
        // $store->phone = $request->phone;
        // $store->photo_shop = $request->photo_shop;
        // $store->village = $request->village;
        // $store->address = $request->address;

        // $store->save();


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
        return redirect()->route('dashboard-customer');
        
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
        return view('pages.customer.open-store.edit', [
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
            return redirect()->route('dashboard-customer')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('dasboard-customer.edit')->with('error', 'data gagal diubah');
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
