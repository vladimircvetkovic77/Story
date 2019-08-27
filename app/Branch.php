<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
     
	protected $fillable = [
		'name',
		 'icon',
		   'tree_id'
		 
		];

     public function leaves()
    {
        return $this->hasMany('App\Leaf');
    }

    public function tree()
    {
        return $this->belongsTo('App\Tree');
    }
}
