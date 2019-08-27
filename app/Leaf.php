<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaf extends Model
{
    
	protected $fillable = [
		'name',
		 'icon',
		 	'branch_id'
		 
		];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
