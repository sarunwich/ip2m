<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IPtype;
use Illuminate\Support\Facades\Validator;
use App\Models\Group;
use App\Models\IPdata;
use App\Models\IPdataDetail;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       

        return view('user.works.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $iptypes = IPtype::all();
        $ipdata = $request->session()->get('ipdata');
        return view('user.works.create', compact('iptypes','ipdata'));
    }
    // public function createStepOne(Request $request)
    // {
    //     $product = $request->session()->get('product');
  
    //     return view('products.create-step-one',compact('product'));
    // }

    public function postCreateStepOne(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'iptype_id' => 'required',
            'ipdid.*' => 'required',
            'ipdata.*' => 'required',
        ],[
            'iptype_id' =>'ประเภท',
            'ipdata.*'=>'กรอกข้อมูลให้ครบถ่วน',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
  
      
             $request->session()->put('ipdata', $request->input());
     
    //    $ipdata= $request->session()->get('ipdata');
        // dd($ipdata);
           return redirect()->route('user.works.create2');
        //  return view('user.works.create2',compact('ipdata'));
    }
    public function createStepTwo(Request $request)
    {
         $ipdata = $request->session()->get('ipdata');
         $groups=Group::all();
         return view('user.works.create2',compact('groups'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'highlight' => 'required',
            'product_detail' => 'required',
            'price' => 'required',
            'display' => 'required',
            'keyword' => 'required',
            'group' => 'required',
            'category' => 'required',
            'fields.*' => 'required|file|mimes:jpeg,png,pdf|max:8192',

        ],[
            'name' => 'Name',
            'highlight' => 'highlight',
            'product_detail' => 'product_detail',
            'price' => 'price',
            'display' => 'display',
            'keyword' => 'คำค้น keyword',
            'group' => 'กลุ่ม group',
            'category' => 'ประเภท category',
            'fields.*' => 'กรอกข้อมูลให้ครบถ่วน',
        ]);
  
        // $product = $request->session()->get('product');
        // $product->fill($validatedData);
        // $request->session()->put('product', $product);
        $ipdata = $request->session()->get('ipdata');
       
        $uid = Auth::user()->id;
        // $model=IPdata::create([
        //     'iptype_id' => $ipdata['iptype_id'],
        //     'rid' => $uid,
        // ]);
        // $id = $model->id;
        // foreach ($ipdata['ipdid'] as $key => $item_ipdid) {
        //     IPdataDetail::create([
        //         'IPdata_id'=>$id,
        //         'ipdetail_id' => $item_ipdid,
        //           'IPdataDetail_data' => $ipdata['ipdata'][$key],
        //     ]);
        // }

        //  dd($ipdata,$request,$id);
         $appid = IdGenerator::generate(['table' => 'i_pdatas', 'length' => 7, 'prefix' => date('ym'), 'reset_on_prefix_change' => true]);
        echo $appid;
         // return redirect()->route('works.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
