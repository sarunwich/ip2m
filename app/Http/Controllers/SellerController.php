<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Phattarachai\ThaiIdCardValidation\ThaiIdCardRule;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $sellers=Seller::join('products', 'products.id', '=', 'sellers.pid')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
        ->where('i_pdatas.rid', '=', $id)
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->get();
// dd($sellers);
        return view('user.seller.index',compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $id = Auth::user()->id;
        // $profiles = Profile::where('rid','=',$id);
        $profiles = DB::table('profiles')
            ->select('profiles.*')
            ->where('rid', '=', $id)
            ->get();

            $products = Product::join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            // ->join('sellers', 'sellers.pid', '<>', 'products.id')
            ->whereNotIn('products.id', DB::table('sellers')->pluck('pid'))
            ->where('i_pdatas.rid', Auth::user()->id)
            // ->where('requestdbs.status', '<=', 2)
            // ->orderByDesc('id')
            ->select('products.*')
        //->get();
            ->get();

        return view('user.seller.create',compact('profiles','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'store_name' => 'required',
            'person_type' => 'required',
            'id_number' => new ThaiIdCardRule,
            'seller_email' => 'required',
            'profile_id' => 'required',
            'pid' => 'required',
            'accept' => 'required',
            

        ],[
            'store_name' => 'store_name',
            'person_type' => 'person_type',
            // 'id_number' => 'id_number',
            'seller_email' => 'seller_email',
            'profile_id' => 'profile_id',
            'pid' => 'pid',
            'accept' => 'accept',
            
        ]);

        Seller::create([
            'store_name'=>$request->input('store_name'),
            'person_type'=>$request->input('person_type'),
            'id_number'=>$request->input('id_number'),
            'seller_email'=>$request->input('seller_email'),
            'profile_id'=>$request->input('profile_id'),
            'pid'=>$request->input('pid'),
            'accept'=>$request->input('accept'),
        ]);
        return redirect()->route('seller.index')->with('success', 'created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
