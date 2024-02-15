<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\IPtype;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Offerbuy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): View
    {
        $id = Auth::user()->id;
        $iptypes=IPtype::all();

        $offerbuys=Offerbuy::where('offerbuys.status','=',1)
        ->where('offerbuys.offerbuy_enddate','>=',date('Y-m-d'))
        ->join('profiles','profiles.profile_id','offerbuys.profile_id')
        ->select('offerbuys.*')
        ->where('profiles.rid', '<>', $id)
        ->with('imagesbuy')
        ->paginate(8);

        if($request->filled('q')){
            $sellers=Product::join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)

        ->where('i_pdatas.rid', '<>', $id)
        ->with('images')
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('product_name', 'like', "%{$request->q}%")
                    ->orWhere('keyword', 'like', "%{$request->q}%")
                    ->orWhere('product_detail', 'like', "%{$request->q}%");
            }
        )
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(8);
        }else{
        $sellers=Product::join('sellers', 'sellers.pid', '=', 'products.id')
        ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
        ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')
         ->where('approves.status', '=', 1)

        ->where('i_pdatas.rid', '<>', $id)
        ->with('images')
        ->select('products.*','sellers.created_at as sellercreated_at','sellers.sid as sid','approves.status as status','approves.updated_at as statusupdated_at')
        ->paginate(8);
        }

        return view('user.home',compact('iptypes','sellers','offerbuys'));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('admin.adminHome');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome(): View
    {
        return view('manager.managerHome');
    }
   
}
