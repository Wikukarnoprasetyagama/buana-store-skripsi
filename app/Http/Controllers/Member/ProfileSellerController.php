<?php

namespace App\Http\Controllers\Member;

use File;
use App\Models\User;
use App\Models\Regency;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.member.profile.seller', [
            'user' => $user
        ]);
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
        $user = User::findOrFail($id);
        $provinces = Province::where('id', 14)->get();
        $regencies = Regency::where('id', 1406)->get();
        $districts = District::where('id', 1406042)->get();
        return view('pages.member.profile.edit-seller', [
            'user' => $user,
            'provinces' => $provinces,
            'regencies' => $regencies,
            'districts' => $districts,
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
        $user = User::findOrFail($id);
        
        $file_photo = $request->file('photo_profile');
        if($file_photo) //jika foto tidak di update
        {
            $filename = $file_photo->getClientOriginalName();
            $data['photo_profile'] = $filename;
            $data['photo_profile'] = $request->file('photo_profile')->store(
                'assets/profile',
                'public'
            );
            $proses = $file_photo->move('assets/profile', 'public');
        }
        

        $user->update($data);
        if ($data) {
            Alert::success('Berhasil!', 'Profil Berhasil Diubah!');
            return redirect()->route('profile-seller.index');
        }else{
            Alert::error('Gagal!', 'Profil Gagal Diubah!');
            return redirect()->route('profile-seller.index');
        }
        // return redirect()->route('profile-seller.index');
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

    // custom
    public function profileSellerUpload(Request $request)
    {
        $data = $request->all();
        if($request->user()->photo_profile){
            Storage::delete('public/' . $request->user()->photo_profile);
        }else{
            Storage::delete('storage/app/public/' . $request->user()->photo_profile);
        }

        $data['photo_profile'] = $request->file('photo_profile')->store(
            'assets/profile',
            'public'
        );

        $user = User::findOrFail(Auth::user()->id);
        $user->update($data);
        return back();
    }
}
