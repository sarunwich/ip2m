<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Offerbuy;
use App\Models\IPtype;
use App\Models\IPdetail;
use App\Models\Group;

use Illuminate\Support\Facades\DB;


class welcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productCount = Product::select('products.group_id as group_id', DB::raw('count(*) as count'))
        ->join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)
         ->groupBy('products.group_id')->get();
        
        $groups=Group::orderBy('groups.order', 'asc')
        ->get();
        
        // dd($groups);
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
        return view('welcome',compact('sellers','offerbuys','groups','productCount'));
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
    public function showproduct($id)
    {
        // dd($id);
        $iptypes = IPtype::all();
        $iPdetails=IPdetail::all();
        $product = Product::join('sellers', 'sellers.pid', '=', 'products.id')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->join('i_ptypes', 'i_ptypes.iptype_id', '=', 'i_pdatas.iptype_id')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('profiles', 'profiles.profile_id', '=', 'sellers.profile_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
            ->where('approves.status', '=', 1)

            ->where('products.id', '=', $id)
            ->with('images')
            ->with('IPdatails')
            ->select('products.*','categories.category_name as category_name','i_ptypes.iptype_name as iptypename', 'profiles.profile_name as pname', 'sellers.created_at as sellercreated_at', 'sellers.sid as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->first();

        //   dd($product);
        return view('showproduct', compact('iptypes', 'product','iPdetails'));
    }
    public function showoffer($id)
    {
        $offerbuy=Offerbuy::where('offerbuys.status','=',1)
        ->where('offerbuys.offerbuy_enddate','>=',date('Y-m-d'))
        ->join('profiles','profiles.profile_id','offerbuys.profile_id')
        ->select('offerbuys.*','profiles.profile_name as profile_name','profiles.tel as profile_tel' )
        ->where('offerbuys.id', '=', $id)
        ->with('imagesbuy')
        ->with('category')
        ->first();
        // dd($offerbuy);
        return view('showoffer', compact('offerbuy'));
    }
    public function categories()
    {
        $groups=Group::orderBy('groups.order', 'asc')
        ->get();
        $sellers=Product::join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)

        // ->where('i_pdatas.rid', '<>', $id)
        ->with('images')
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(8);

        return view('categories', compact('groups','sellers'));
    }
    public function findgroup($id)
    {
        $groups=Group::orderBy('groups.order', 'asc')
        ->get();
        $sellers=Product::join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)
         ->where('products.group_id', '=', $id)
        // ->where('i_pdatas.rid', '<>', $id)
        ->with('images')
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(8);
        return view('categories', compact('groups','sellers'));
    }
}
