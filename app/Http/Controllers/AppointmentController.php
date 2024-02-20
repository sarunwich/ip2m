<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Appointment;
use App\Models\Offerbuy;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Phattarachai\LineNotify\Facade\Line;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $id = Auth::user()->id;

        $response_offerbuys = Offerbuy::join('response_offerbuys', 'response_offerbuys.offerbuy_id', 'offerbuys.id')
            ->join('profiles', 'profiles.profile_id', 'offerbuys.profile_id')
            ->select('offerbuys.*', 'profiles.profile_name as profile_name', 'profiles.tel as profile_tel', 'response_offerbuys.id as resid', 'response_offerbuys.response_date as response_date', 'response_offerbuys.response_detail as response_detail', 'response_offerbuys.status as status')
            ->with('category')
            ->where('response_offerbuys.res_id', '=', $id)
            ->orderby('created_at', 'desc')
            ->paginate(5);

        $sellers = Seller::join('products', 'products.id', '=', 'sellers.pid')
            ->join('i_pdatas', 'i_pdatas.id', '=', 'products.IPdata_id')
            ->leftJoin('approves', 'approves.sid', '=', 'sellers.sid')

            ->where('i_pdatas.rid', '=', $id)
            ->with('appointments')
            ->select('products.*', 'sellers.created_at as sellercreated_at', 'sellers.sid as sid', 'approves.status as status', 'approves.updated_at as statusupdated_at')
            ->orderby('created_at', 'desc')
            ->paginate(5);
        $appointments = Appointment::where('appointments.rid', Auth::user()->id)
            ->join('sellers', 'sellers.sid', '=', 'appointments.sid')
            ->join('products', 'products.id', '=', 'sellers.pid')
            ->join('profiles', 'profiles.profile_id', '=', 'sellers.profile_id')

            ->select('appointments.*', 'products.product_name as product_name', 'profiles.profile_name as profile_name', 'profiles.tel as tel', 'sellers.store_name as store_name')
            ->orderby('created_at', 'desc')
            ->paginate(5);
        return view('user.appointment.index', compact('appointments', 'sellers', 'users', 'response_offerbuys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $id = $request->sid;
        return view('user.appointment.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'appointment_time' => 'required',
            'appointment_detail' => 'sometimes|required',
        ]);
        $uid = Auth::user()->id;
        $model = Appointment::create([
            'sid' => $request->input('sid'),
            'appointment_time' => $request->input('appointment_time'),
            'purpose1' => $request->input('purpose1'),
            'purpose2' => $request->input('purpose2'),
            'purpose3' => $request->input('purpose3'),
            'other' => $request->input('other'),
            'appointment_detail' => $request->input('appointment_detail'),
            'rid' => $uid,
        ]);

        $sellers=Seller::where('sid','=',$request->input('sid'))
        ->with('product')
        ->first();
// dd($sellers);


// จากใน Controller หรือที่อื่น ๆ

//  Line::send('ทดสอบส่งข้อความ');
        $email = Auth::user()->email;
        $firstname = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $prefix = Auth::user()->prefix;
        //หรือ ใช้ relationship เรียกจากตาราง user
        //$email = $article->user->email;
        $SendMail = [
            'title' => 'ติดต่อนัดหมาย สินค้าที่สนใจ',
            'body' => 'เรียนคุณ' . $firstname .' '.$lastname . ' ได้ติดต่อนัดหมาย สินค้าที่ i2M'.$sellers->pid.' '.$sellers->product->product_name .' วันที่'.$request->input('appointment_time'),
            // 'idip' => '::' . $request->id_ip . '',
            // 'nameip' => ':: ' . $requestdb['ip_thainame'] . '',
            // 'iptype' => ':: ' . $requestdb['iptype_name'] . '',
            // 'status' => ':: แนบหลักฐานการชำระเงิน',
            'URL' => 'ท่านสามารถตรวจสอบข้อมูลได้ทาง ' . env('APP_URL') . ' ',

        ];

         Mail::to($email)->send(new SendMail($SendMail));

        return redirect()->route('appointment.index')->with('success', 'Appointment successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
    public function upreadApp(Request $request)
    {
        $Appointment = Appointment::find($request->id);
        $Appointment->status_appointments = 1;
        $Appointment->save();

        return response()->json(['success' => 'Status read successfully.']);
    }
}
