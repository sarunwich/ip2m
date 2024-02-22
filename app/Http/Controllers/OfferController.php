<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Approve;
use App\Models\Offerbuy;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Phattarachai\LineNotify\Facade\Line;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sellers = Seller::join('products', 'products.id', '=', 'sellers.pid')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.id')
        // ->where('i_pdatas.rid', '=', $id)
            ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.id as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->paginate(10);
        return view('admin.offer.index', compact('sellers'));
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
        $offerbuy = Offerbuy::where('offerbuys.status', '=', 1)
            ->where('offerbuys.offerbuy_enddate', '>=', date('Y-m-d'))
            ->join('profiles', 'profiles.profile_id', 'offerbuys.profile_id')
            ->select('offerbuys.*')
            ->where('offerbuys.id', '<>', $offerbuy->id)
            ->with('imagesbuy')
            ->first();
        return view('user.showoffer', compact('offerbuy'));
    }
    public function offerShow(Offerbuy $offerbuy)
    {
        //
        $offerbuy = Offerbuy::where('offerbuys.status', '=', 1)
        // ->where('offerbuys.offerbuy_enddate','>=',date('Y-m-d'))
            ->join('profiles', 'profiles.profile_id', 'offerbuys.profile_id')
            ->select('offerbuys.*', 'profiles.profile_name as profile_name', 'profiles.tel as profile_tel')
            ->where('offerbuys.id', '<>', $offerbuy->id)
            ->with('imagesbuy')
            ->with('category')
            ->first();
        return view('admin.offer.showoffer', compact('offerbuy'));
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
    public function update(Request $request)
    {
        //
        try {
            $offerbuy = Offerbuy::findOrFail($request->id);
            $offerbuy->offerbuy_enddate = $request->enddate;
            $offerbuy->save();
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update date.'], 500);
        }
// return response($offerbuy);
        return response()->json(['success' => true, 'message' => 'Date updated successfully.']);
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
        $seller = Seller::where('id', $request->id)
            ->with('product')
            ->with('profile')
            ->first();
        $email = $seller->profile->user->email;
        // $email = Auth::user()->email;
        // $firstname = Auth::user()->firstname;
        // $lastname = Auth::user()->lastname;
        // $prefix = Auth::user()->prefix;
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
                'manager_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        if ($request->status == 1) {
            $status = "อนุมัติ";
        } else {
            $status = "ไม่อนุมัติ";
        }
        $SendMail = [
            'title' => 'ข้อมูลสถานะ เสนอขาย',
            'body' => 'เรียนคุณ' . $seller->profile->user->firstname . ' ' . $seller->profile->user->lastname . ' ข้อมูลเสนอขาย ที่เลขที่ S' . $seller->id . ' สินค้าเลขที่ ip2m' . $seller->product->id . ' ' . $seller->product->product_name . ' สถานะ :: ' . $status . '',

            'URL' => 'ท่านสามารถตรวจสอบข้อมูลได้ทาง ' . env('APP_URL') . ' ',

        ];

        Mail::to($email)->send(new SendMail($SendMail));
        Line::send('ข้อมูลเสนอขาย ' . PHP_EOL . 'ที่เลขที่ :: S' . $seller->id . '' . PHP_EOL . 'สินค้าเลขที่ :: ip2m' . $seller->product->id . '' . PHP_EOL . 'ชื่อ :: ' . $seller->product->product_name . '' . PHP_EOL . 'สถานะ :: ' . $status . '');

        return response()->json($approve);
    }
    public function offerBuy()
    {
        // return view('OK');
        $Offerbuys = Offerbuy::paginate(10);

        // dd($Offerbuys);
        return view('admin.offer.offerbuy', compact('Offerbuys'));
    }
    public function upstatusoffer(Request $request)
    {
        $Offerbuy = Offerbuy::where('id', $request->id)
            ->with('profile')
            ->first();

        // User found, do something with it
        $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->addMonth();
        $Offerbuy->status = $request->status;
        $Offerbuy->endorser_id = Auth::user()->id;
        $Offerbuy->offerbuy_startdate = date('Y-m-d');
        $Offerbuy->offerbuy_enddate = $date;

        $Offerbuy->save();
        $email = $Offerbuy->profile->user->email;

        if ($request->status == 1) {
            $status = "อนุมัติ";
        } else {
            $status = "ไม่อนุมัติ";
        }
        $SendMail = [
            'title' => 'ข้อมูลสถานะ เสนอซื้อ',
            'body' => 'เรียนคุณ' . $Offerbuy->profile->user->firstname . ' ' . $Offerbuy->profile->user->lastname . ' ข้อมูลเสนอซื้อ ที่เลขที่ F' . $Offerbuy->id . ' ผลงานที่สนใจ' . $Offerbuy->Interest_data . ' ' . PHP_EOL . ' สถานะ :: ' . $status . '',

            'URL' => 'ท่านสามารถตรวจสอบข้อมูลได้ทาง ' . env('APP_URL') . ' ',

        ];

        Mail::to($email)->send(new SendMail($SendMail));
        Line::send('ข้อมูลเสนอซื้อ ' . PHP_EOL . 'ที่เลขที่ :: F' . $Offerbuy->id . '' . PHP_EOL . 'ผลงานที่สนใจ' . $Offerbuy->Interest_data . '' . PHP_EOL . 'สถานะ :: ' . $status . '' . PHP_EOL . ' ตรวจสอบข้อมูล ' . env('APP_URL') . '');

        return redirect()->back()->with('success', 'Record updated successfully!');
    }
}
