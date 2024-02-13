<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Offerbuy;
use App\Models\ProductImagebuy;
use App\Models\Category;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $Offerbuys =Offerbuy::join('profiles','profiles.profile_id','offerbuys.profile_id')
        ->select('offerbuys.*')
        ->where('profiles.rid', '=', $id)
        ->paginate(10);
        // dd( $Offerbuys);
        return view('user.buy.index',compact('Offerbuys'));
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

        $groups = Group::all();
        return view('user.buy.create', compact('groups', 'profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $offid = IdGenerator::generate(['table' => 'offerbuys', 'length' => 7, 'prefix' => date('ym'), 'reset_on_change' => 'prefix']);
        // dd($offid);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'profile_id' => 'required',
            'Interest_data' => 'required',
            'offbuy_detail' => 'required',
            'offerbuy_price' => 'required',
            'fields.*' => 'sometimes|required|file|mimes:jpeg,png,pdf|max:8192',

        ], [
            'category_id' => 'หมวดหมู่',
            'Interest_data' => 'ผลงานที่สนใจ',
            'offbuy_detail' => 'รายละเอียด',
            'offerbuy_price' => 'งบประมาณ',
            'profile_id' => 'ข้อมูลติดต่อ',
            // 'fields.*' => 'กรอกข้อมูลให้ครบถ่วน',
        ]);
        Offerbuy::insert([
            'id' => $offid,
            'category_id' => $request->input('category_id'),
            'profile_id' => $request->input('profile_id'),
            'Interest_data' => $request->input('Interest_data'),
            'offbuy_detail' => $request->input('offbuy_detail'),
            'offerbuy_price' => $request->input('offerbuy_price'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // Store the uploaded files
        $files = $request->file('fields');
        if ($files) {
            foreach ($files as $file) {

                $name = $offid . '_' . time() . '_' . $file->getClientOriginalName();
                $path = $file->storeas('public/ProductImagebuys', $name);
                // File::create(['name' => $name, 'path' => $path]);

                // $path = $uploadedFile->store('ProductImage'); // Store the file in the "uploads" directory
                
                // Save file details to the database
                ProductImagebuy::create([
                    'ProductImagebuy_name' => $name,
                    'offerbuy_id' => $offid,
                    'path' => $path,

                ]);
            }
        }
        return redirect()->route('buy.index')->with('success', 'Data inserted successfully!');

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
        ->select('offerbuys.*','profiles.profile_name as profile_name','profiles.tel as profile_tel' )
        ->where('offerbuys.id', '<>', $offerbuy->id)
        ->with('imagesbuy')
        ->with('category')
        ->first();
        return view('user.showoffer', compact('offerbuy'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $groups = Group::all();
        $Categorys=Category::all();
        $offerbuy = Offerbuy::with('imagesbuy')
        ->findOrFail($id);

        $groups_id=Category::findOrFail($offerbuy->category_id);
       
        $profiles = DB::table('profiles')
        ->select('profiles.*')
        ->where('rid', '=', Auth::user()->id)
        ->get();
        // dd($profiles);
        return view('user.buy.edit', compact('offerbuy','groups','profiles','groups_id','Categorys'));
      

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
      
       $offerbuy = Offerbuy::findOrFail($id);
    //    dd( $offerbuy);
       $offerbuy->category_id = $request->input('category_id');
       $offerbuy->profile_id = $request->input('profile_id');
       $offerbuy->Interest_data =$request->input('Interest_data');
       $offerbuy->offbuy_detail = $request->input('offbuy_detail');
       $offerbuy->offerbuy_price = $request->input('offerbuy_price');
        $offerbuy->save();
        $files = $request->file('fields');
        if ($files) {
            foreach ($files as $file) {

                $name = $id . '_' . time() . '_' . $file->getClientOriginalName();
                $path = $file->storeas('public/ProductImagebuys', $name);
                // File::create(['name' => $name, 'path' => $path]);

                // $path = $uploadedFile->store('ProductImage'); // Store the file in the "uploads" directory
                
                // Save file details to the database
                ProductImagebuy::create([
                    'ProductImagebuy_name' => $name,
                    'offerbuy_id' => $id,
                    'path' => $path,

                ]);
            }
        }
        return redirect()->route('buy.index')->with('success', 'Data Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offerbuy $offerbuy,$id)
    {
        //
        $offerbuy = Offerbuy::findOrFail($id);
        $offerbuy->imagesbuy()->delete();
        $offerbuy->delete();
        // $offerbuy->delete();
         return redirect()->route('buy.index')->with('success', 'Data Delete successfully!');
    }
}
