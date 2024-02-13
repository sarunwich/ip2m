<?php

namespace App\Http\Controllers;

use App\Models\Response_offerbuy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ResponseOfferbuyController extends Controller
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
    public function create(Request $request)
    {
        //
        $id=$request->id;
        return view('user.buy.response',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'response_detail' => 'required',
           
        ]);
        $res = IdGenerator::generate(['table' => 'response_offerbuys', 'length' => 7, 'prefix' => date('ym'), 'reset_on_change' => 'prefix']);
   
        $uid = Auth::user()->id;
        $model=Response_offerbuy::insert([
            'id'=>$res,
            'offerbuy_id'=>$request->input('id'),
            'response_detail' => $request->input('response_detail'),
            'response_date'=>date('Y-m-d H:i:s'),
            'res_id' => $uid,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->route('home')->with('success', 'Response successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Response_offerbuy $response_offerbuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response_offerbuy $response_offerbuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Response_offerbuy $response_offerbuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response_offerbuy $response_offerbuy)
    {
        //
    }
}
