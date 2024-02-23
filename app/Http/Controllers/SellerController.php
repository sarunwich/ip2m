<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Phattarachai\ThaiIdCardValidation\ThaiIdCardRule;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use Phattarachai\LineNotify\Facade\Line;
use App\Mail\SendMail;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $sellers = Seller::join('products', 'products.id', '=', 'sellers.pid')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
            ->where('i_pdatas.rid', '=', $id)
            ->orderBy('sellers.id', 'DESC')
            ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.id as sid' ,'sellers.status_sell as status_sell', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->paginate(10);
// dd($sellers);
        return view('user.seller.index', compact('sellers'));
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

        return view('user.seller.create', compact('profiles', 'products'));
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
            // 'seller_email' => 'required',
            'profile_id' => 'required',
            'pid' => 'required',
            'accept' => 'required',

        ], [
            'store_name' => 'store_name',
            'person_type' => 'person_type',
            // 'id_number' => 'id_number',
            // 'seller_email' => 'seller_email',
            'profile_id' => 'profile_id',
            'pid' => 'pid',
            'accept' => 'accept',

        ]);
        $sid = IdGenerator::generate(['table' => 'sellers', 'length' => 7, 'prefix' => date('ym'),'reset_on_change'=>'prefix']);
    //    dd( $sid);
        $profile= Profile ::where('profiles.profile_id', $request->input('profile_id'))
        ->select('profiles.*')
        ->first();
        $products = Product::where('products.id', $request->input('pid'))
        ->select('products.*')
        ->first();
        $model= Seller::insert([
            'id'=>$sid ,
            'store_name' => $request->input('store_name'),
            'person_type' => $request->input('person_type'),
            'id_number' => $request->input('id_number'),
            // 'seller_email' => $request->input('seller_email'),
            'profile_id' => $request->input('profile_id'),
            'pid' => $request->input('pid'),
            'accept' => $request->input('accept'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // $id = $model->id;
        $email = Auth::user()->email;
        $firstname = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $prefix = Auth::user()->prefix;
        $SendMail = [
            'title' => 'เพิ่มข้อมูล เสนอขาย',
            'body' => 'เรียนคุณ' . $firstname .' '.$lastname . ' ได้เพิ่มข้อมูลเสนอขาย เลขที่ S'.$sid.'สินค้าเลขที่ ip2m'.$products['id'].' '.$products['product_name'].' ',
            
            'URL' => 'ท่านสามารถตรวจสอบข้อมูลได้ทาง ' . env('APP_URL') . ' ',

        ];

         Mail::to($email)->send(new SendMail($SendMail));
         Line::send('คุณ' . $firstname .' '.$lastname . ' ได้เพิ่มข้อมูลเสนอขาย '. PHP_EOL .'เลขที่ :: S'.$sid.''. PHP_EOL .' สินค้าเลขที่ :: ip2m'.$products['id'].''. PHP_EOL .'ชื่อ :: '.$products['product_name'].''. PHP_EOL .'สถานะ :: รออนุมัติ '. PHP_EOL .' ตรวจสอบข้อมูล ' . env('APP_URL') . '');
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
        $id = Auth::user()->id;
        // $profiles = Profile::where('rid','=',$id);
        $profiles = DB::table('profiles')
            ->select('profiles.*')
            ->where('rid', '=', $id)
            ->get();
        $products = Product::join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            // ->whereNotIn('products.id', DB::table('sellers')->pluck('pid'))
            ->where('i_pdatas.rid', Auth::user()->id)
            ->select('products.*')
            ->get();
        return view('user.seller.edit', compact('seller', 'profiles','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        //
        
        $validatedData = $request->validate([
            'store_name' => 'required',
            'person_type' => 'required',
            'id_number' => new ThaiIdCardRule,
            // 'seller_email' => 'required',
            'profile_id' => 'required',
            'pid' => 'required',
            'accept' => 'required',

        ], [
            'store_name' => 'store_name',
            'person_type' => 'person_type',
            // 'id_number' => 'id_number',
            // 'seller_email' => 'seller_email',
            'profile_id' => 'profile_id',
            'pid' => 'pid',
            'accept' => 'accept',

        ]);
        $seller->store_name=$request->store_name;
        $seller->person_type=$request->person_type;
        $seller->id_number=$request->id_number;
        $seller->profile_id=$request->profile_id;
        $seller->pid=$request->pid;
        $seller->accept=$request->accept;
        $seller->save();
        return redirect()->route('seller.index')->with('success', 'Seller Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
        $seller->delete();
        return redirect()->back()->with('success', 'Del successfully.');
    }
    public function changeSellStatus(Request $request)
    {


        $seller = Seller::find($request->id);
        $seller->status_sell = $request->status;
        $seller->save();

        $seller = Seller::where('id', $request->id)
        ->with('product')
        ->with('profile')
        ->first();
    $email = $seller->profile->user->email;
    if ($request->status == 1) {
        $status = "เปิดการขาย";
    } else {
        $status = "ปิดการขาย";
    }
    $SendMail = [
        'title' => 'ข้อมูล เสนอขาย',
        'body' => 'เรียนคุณ' . $seller->profile->user->firstname . ' ' . $seller->profile->user->lastname . ' ข้อมูลเสนอขาย เลขที่ S' . $seller->id . ' สินค้าเลขที่ ip2m' . $seller->product->id . ' ' . $seller->product->product_name . ' สถานะ :: '.$status.'',

        'URL' => 'ท่านสามารถตรวจสอบข้อมูลได้ทาง ' . env('APP_URL') . ' ',

    ];

    Mail::to($email)->send(new SendMail($SendMail));
    Line::send('ข้อมูลเสนอขาย ' . PHP_EOL . 'เลขที่ :: S' . $seller->id . '' . PHP_EOL . 'สินค้าเลขที่ :: ip2m' . $seller->product->id . '' . PHP_EOL . 'ชื่อ :: ' . $seller->product->product_name . '' . PHP_EOL . 'สถานะ :: '.$status.'');
    


        return response()->json(['success' => 'Status change successfully.']);
    }
}
