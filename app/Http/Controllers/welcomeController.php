<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Offerbuy;

class welcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $offerbuys=Offerbuy::where('status','=',1)
        ->where('offerbuy_enddate','>=',date('Y-m-d'))
         ->with('imagesbuy')
        ->paginate(8);

        $sellers=Product::join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)

        // ->where('i_pdatas.rid', '<>', $id)
        ->with('images')
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(8);
        // dd($offerbuys);
        return view('welcome',compact('sellers','offerbuys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
