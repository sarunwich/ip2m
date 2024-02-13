<?php

namespace App\Http\Controllers;

use App\Models\ProductImagebuy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductImagebuyController extends Controller
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
    public function show(ProductImagebuy $productImagebuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImagebuy $productImagebuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImagebuy $productImagebuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImagebuy $productImagebuy)
    {
        //
        $productImagebuy->delete();
        return redirect()->back()->with('success', 'ProductImage delete successfully!');
    }
}
