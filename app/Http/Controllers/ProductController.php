<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IPdata;
use App\Models\IPtype;
use App\Models\Product;
use App\Models\User;
use App\Models\product_user;
use Illuminate\Http\Request;
use App\Models\IPdetail;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Product $product)
    {
        // dd($product);
        //
        $iptypes = IPtype::all();
        $iPdetails=IPdetail::all();
        $product = Product::join('sellers', 'sellers.pid', '=', 'products.id')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->join('i_ptypes', 'i_ptypes.iptype_id', '=', 'i_pdatas.iptype_id')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('profiles', 'profiles.profile_id', '=', 'sellers.profile_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
            ->where('approves.status', '=', 1)

            ->where('products.id', '=', $product->id)
            ->with('images')
            ->with('IPdatails')
            ->select('products.*','categories.category_name as category_name','i_ptypes.iptype_name as iptypename', 'profiles.profile_name as pname', 'sellers.created_at as sellercreated_at', 'sellers.id as sid', 'sellers.status_sell as status_sell', 'sellers.created_at as sellercreated_at', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->first();
            $product->increment('view_count');
        //   dd($product);
        return view('user.showproduct', compact('iptypes', 'product','iPdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        // $product = Product::find($product->id);
        // $product->delete();

        $product = Product::find($product->id);
        $IPdata = IPdata::find($product->IPdata_id);

        if ($product) {
            // Delete associated images
            $product->IPdata_id = null;
            $product->images()->delete();
            // $product->IPdata()->delete();
            // Delete the product itself
            $product->delete();
        }
        if ($IPdata) {
            $IPdata->IPdataDetail()->delete();
            $IPdata->delete();
        }
        return redirect()->back()->with('success', 'Del successfully.' . $product->IPdata_id);
    }
    public function changeStatus(Request $request)
    {
        $product = Product::find($request->id);
        $product->display = $request->status;
        $product->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
    public function like($id)
{
    $product = Product::findOrFail($id);
    // dd($id);
    // ตรวจสอบว่าผู้ใช้เคยกดถูกใจสินค้านี้ไปแล้วหรือไม่
    if (!Auth::user()->likedProducts()->where('product_id', $id)->exists()) {
        // บันทึกข้อมูลการถูกใจ
        // $model= product_user::create([
           
        //     'user_id' => Auth::user()->id,
        //     'product_id' => $id,
          
        // ]);
        Auth::user()->likedProducts()->syncWithoutDetaching($id);
        $product->increment('likes_count'); // บันทึกจำนวนการถูกใจของสินค้า
    }
    

    return redirect()->back();
}
}
