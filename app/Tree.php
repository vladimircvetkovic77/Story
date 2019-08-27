<?php

namespace App;

use App\Branch;
use App\Leaf;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{

	protected $fillable = [
		'name',
		 'icon'
		 
		];


     public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function leaves()
{
    return $this->hasManyThrough(Leaf::class, Branch::class);
}

}
