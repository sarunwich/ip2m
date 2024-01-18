<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amphur;
use App\Models\District;

class DropdownController extends Controller
{
    //
    public function getAmphur(Request $request)
    {
        $province_id = $request->input('province_id');
        $amphurs = Amphur::where('PROVINCE_ID', $province_id)->get();
        return response()->json(['amphurs' => $amphurs]);
    }

    public function getDistrict(Request $request)
    {
        $amphur_id = $request->input('amphur_id');
        $districts = District::where('AMPHUR_ID', $amphur_id)->get();
        return response()->json(['districts' => $districts]);
    }
}
