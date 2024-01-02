<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\Input;

// use App;

class LangController extends Controller
{
    //
    public function index()
    {
        return view('lang');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
  
        return redirect()->back();
    }
    public function languageswitch(Request $request)
    {
        $language=$request->input('language');
        session(['language'=>$language]);
        return redirect()->back()->with(['language_switched'=>$language]);
    }
}
