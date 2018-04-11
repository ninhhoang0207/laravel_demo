<?php

namespace App\Http\Controllers\Admin;

use App\Disease;
use App\Gene;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables, DB;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.disease.index');
    }

    public function getData() {
        $diseases = Disease::select(['id', 'name_en']);

        return Datatables::of($diseases)
            ->addColumn('detail_url', function($disease) {
                                return route('admin.disease.detail', $disease);
                            })
            ->make(true);
    }

    public function detail(Disease $disease) {
        $genes = Gene::paginate(20);

        return view('admin.disease.ajax_detail', compact(['disease', 'genes']))->render();
    }

    public function addDiseaseGene(Request $request) {
        $disease_id = $request->disease_id;
        $gene_id = $request->gene_id;

        $db = DB::table('diseases_genes')->insert(['disease_id' => $disease_id, 'gene_id' => $gene_id]);
        if ($db){
            return route('admin.disease.detail', $disease_id);
        }
        return 0;
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
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        //
    }
}
