<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // get all provinces
    public function provinces(Request $request)
    {
        return Province::all();
    }
    public function regencies(Request $request)
    {
        return Regency::all();
    }

    // get all regencies
    // public function regencies(Request $request, $provinces_id)
    // {
    //     return Regency::where('province_id', $provinces_id)->get();
    // }

    public function districts(Request $request)
    {
        return District::all();
    }

    // get all villages
    public function villages(Request $request, $districts_id)
    {
        return Village::where('districts_id', $districts_id)->get();
    }
}
