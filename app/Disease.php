<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'diseases';
    protected $guarded = array();

    public function genes(){
    	return $this->belongsToMany('App\Gene', 'diseases_genes','disease_id', 'gene_id');
    }
}
