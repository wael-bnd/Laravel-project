<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded=[];

    public function formateur(){
    	return $this->belongsTo('App\Formateur::class');
    }
}
