<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\IPtype;
use App\Models\Offerbuy;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        $iptypes = IPtype::all();
        $groups = Group::orderBy('order', 'asc')
            ->get();
        $offerbuys = Offerbuy::where('offerbuys.status', '=', 1)
            ->where('offerbuys.offerbuy_enddate', '>=', date('Y-m-d'))
            ->join('profiles', 'profiles.profile_id', 'offerbuys.profile_id')
            ->select('offerbuys.*')
            // ->where('profiles.rid', '<>', $id)
            ->with('imagesbuy')
            ->paginate(8);

        if ($request->filled('q')) {
            $sellers = Product::join('sellers', 'sellers.pid', '=', 'products.id')
                ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
                ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
                ->where('approves.status', '=', 1)

                // ->where('i_pdatas.rid', '<>', $id)
                ->with('images')
                ->when(
                    $request->q,
                    function (Builder $builder) use ($request) {
                        $builder->where('product_name', 'like', "%{$request->q}%")
                            ->orWhere('keyword', 'like', "%{$request->q}%")
                            ->orWhere('product_detail', 'like', "%{$request->q}%");
                    }
                )
                ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.id as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
                ->paginate(8);
        } else {
            $sellers = Product::join('sellers', 'sellers.pid', '=', 'products.id')
                ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
                ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
                ->where('approves.status', '=', 1)

                // ->where('i_pdatas.rid', '<>', $id)
                ->with('images')
                ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.id as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
                ->paginate(8);
        }

        return view('user.home', compact('iptypes', 'sellers', 'offerbuys', 'groups'));
    }

    public function findtype($fid)
    {
        $id = Auth::user()->id;
        $iptypes = IPtype::all();
        $groups = Group::orderBy('order', 'asc')
            ->get();
        $offerbuys = Offerbuy::where('offerbuys.status', '=', 1)
            ->where('offerbuys.offerbuy_enddate', '>=', date('Y-m-d'))
            ->join('profiles', 'profiles.profile_id', 'offerbuys.profile_id')
            ->select('offerbuys.*')
            // ->where('profiles.rid', '<>', $id)
            ->with('imagesbuy')
            ->paginate(8);
        $sellers = Product::join('sellers', 'sellers.pid', '=', 'products.id')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
            ->where('approves.status', '=', 1)
            ->where('i_pdatas.iptype_id', '=', $fid)
            // ->where('i_pdatas.rid', '<>', $id)
            ->with('images')
            ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.id as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->paginate(8);
        return view('user.home', compact('iptypes', 'sellers', 'offerbuys', 'groups'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        // Retrieve and organize data for product count by month and group
    $productData = Product::selectRaw('MONTH(products.created_at) as month, products.group_id as group_id, COUNT(*) as count')
    ->join('sellers', 'sellers.pid', '=', 'products.id')
    ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
    ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
    ->where('approves.status', '=', 1)
    ->groupBy('month', 'group_id')
    ->get();

// Retrieve and organize data for offer buy count by month and group
$offerbuyData = Offerbuy::selectRaw('MONTH(offerbuys.created_at) as month, groups.group_id as group_id, COUNT(*) as offerCount')
    ->join('categories', 'categories.category_id', '=', 'offerbuys.category_id')
    ->join('groups', 'groups.group_id', '=', 'categories.group_id')
    ->where('offerbuys.status', '=', 1)
    ->where('offerbuys.offerbuy_enddate', '>=', date('Y-m-d'))
    ->groupBy('month', 'group_id')
    ->get();
    // Get all groups
    $groups = Group::orderBy('order', 'asc')->get();
        return view('admin.adminHome', compact('productData', 'offerbuyData', 'groups'));
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
