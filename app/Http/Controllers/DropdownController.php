<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amphur;
use App\Models\District;
use App\Models\IPgroup;
use App\Models\IPdetail;
use App\Models\Category;

class DropdownController extends Controller
{
    //
    public function getCategory(Request $request)
    {
        $group_id = $request->input('group_id');
        $categorys = Category::where('group_id', $group_id)->get();
        return response()->json(['categorys' => $categorys]);
    }

    public function getDistrict(Request $request)
    {
        $amphur_id = $request->input('amphur_id');
        $districts = District::where('AMPHUR_ID', $amphur_id)->get();
        return response()->json(['districts' => $districts]);
    }
    public function getiptypedetail(Request $request)
    {
        $iptype_id = $request->input('iptype_id');
        $ipdetails = IPgroup::where('iptype_id', $iptype_id)
        ->join('i_pdetails', 'i_pdetails.ipdetail_id', '=', 'i_pgroups.ipdetail_id')
        ->select('i_pdetails.*')
        ->get();
        // $ipdetailsdata='';
        // foreach($ipdetails as $key => $ipdetail){
        //     $ipdetailsdata.='<div class="row g-2"><div class="col"> <input type="'.$ipdetail->type.'"name="ipdata[]" class="form-control" placeholder="'.$ipdetail->ipdetail_name.'" aria-label="'.$ipdetail->ipdetail_name.'" value="'.old('ipdata.0').'"></div></div>';
        // }
         return response()->json(['ipdetails' => $ipdetails]);
        // return response($ipdetailsdata);
        // return response()->json(['ipdetailsdata' => $ipdetailsdata]);
    }

}
