<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Approve;
use App\Models\Offerbuy;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sellers=Seller::join('products', 'products.id', '=', 'sellers.pid')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
        // ->where('i_pdatas.rid', '=', $id)
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(10);
        return view('admin.offer.index',compact('sellers'));
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
    public function show(Offerbuy $offerbuy)
    {
        //
        $offerbuy=Offerbuy::where('offerbuys.status','=',1)
        ->where('offerbuys.offerbuy_enddate','>=',date('Y-m-d'))
        ->join('profiles','profiles.profile_id','offerbuys.profile_id')
        ->select('offerbuys.*')
        ->where('offerbuys.id', '<>', $offerbuy->id)
        ->with('imagesbuy')
        ->first();
        return view('user.showoffer', compact('offerbuy'));
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
    public function upStatus(Request $request)
    {
        // dd($request);
        $approve = Approve::where('sid', $request->id)->first();
        if ($approve) {
            // User found, do something with it
            $approve->status = $request->status;
            $approve->manager_id = Auth::user()->id;
            $approve->save();

        } else {
            // User not found
            $approve = Approve::insert([
                'sid' => $request->id,
                'status' => $request->status,
                'manager_id'=>Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return response()->json($approve);
    }
    public function offerBuy()
    {
        // return view('OK');
        $Offerbuys =Offerbuy::all();
        // dd($Offerbuys);
        return view('admin.offer.offerbuy',compact('Offerbuys'));
    }
    public function upstatusoffer(Request $request)
    {
        $Offerbuy = Offerbuy::where('id', $request->id)->first();
       
            // User found, do something with it
            $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->addMonth();
            $Offerbuy->status = $request->status;
            $Offerbuy->endorser_id = Auth::user()->id;
            $Offerbuy->offerbuy_startdate = date('Y-m-d');
            $Offerbuy->offerbuy_enddate = $date;

            $Offerbuy->save();

            return redirect()->back()->with('success', 'Record updated successfully!');
    }
}
