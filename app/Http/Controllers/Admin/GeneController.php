<?php

namespace App\Http\Controllers\Admin;

use App\Gene;
use App\Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function show(Gene $gene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function edit(Gene $gene)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gene $gene)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gene $gene)
    {
        //
    }

    public function searchGenen(Request $request) 
    {
        $genes = Gene::where('name', 'like', $request->keyword)->get()->toJson();

        return $genes;
    }
}
