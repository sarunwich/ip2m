<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        // $profiles = Profile::where('rid','=',$id);
        $profiles = DB::table('profiles')
            ->select('profiles.*')
            ->where('rid', '=', $id)
            ->get();
        // dd($id,$profiles);
        return view('user.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $provinces = Province::all();
        return view('user.profiles.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'profile_name' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
            'country' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'tombon' => 'required|string|max:100',
            'zipcode' => 'required|string|min:5|max:5',
            'tel' => 'required|string|min:9|max:10',
            'website' => 'required|string|max:100',
            'facebook' => 'required|string|max:100',
            'twitter' => 'required|string|max:100',
            'line' => 'required|string|max:100',
            'Instagram' => 'required|string|max:100',

        ],[
           'profile_picture'=>'The profile picture field must not be greater than 5120 kilobytes.'
        ]);

        if ($request->hasfile('profile_picture')) {

            $filename = $request->file('profile_picture')->getClientOriginalName();
            $filename = explode(".", $filename);
            $name = "P_" . $filename[0] . "_" . time() . rand(1, 100) . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_picture', $name);

            $uid = Auth::user()->id;
            // $data = [
            //     'profile_name' => $request->profile_name,
            //     'institute' => $request->institute,
            //     'profile_picture' => $name, // max 5MB
            //     'country' => $request->country,
            //     'address' => $request->address,
            //     'province' => $request->province,
            //     'district' => $request->district,
            //     'tombon' => $request->tombon,
            //     'zipcode' => $request->zipcode,
            //     'tel' => $request->tel,
            //     'website' => $request->website,
            //     'facebook' => $request->facebook,
            //     'twitter' => $request->twitter,
            //     'line' => $request->line,
            //     'Instagram' => $request->Instagram,
            //     'rid' => $uid,
            //     // Add more columns and values as needed
            // ];
// dd($data);
            // dd($uid);
            Profile::insert([
                'profile_name' => $request->profile_name,
                'institute' => $request->institute,
                'profile_picture' => $name, // max 5MB
                'country' => $request->country,
                'address' => $request->address,
                'province' => $request->province,
                'district' => $request->district,
                'tombon' => $request->tombon,
                'zipcode' => $request->zipcode,
                'tel' => $request->tel,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'line' => $request->line,
                'Instagram' => $request->Instagram,
                'rid' => $uid,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('profiles.index')->with('success', 'Profile created successfully');
        } else {
            return redirect()->route('profiles.index')->with('error', 'Profile created error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
        // dd($profile);
        // $Profile = Profile::find($profile);
        $profile->delete();
        return redirect()->back()->with('success', 'Del successfully.');
    }
}
