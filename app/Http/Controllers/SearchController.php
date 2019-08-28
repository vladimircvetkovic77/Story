<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Leaf;
use App\Tree;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){

    	$list = Tree::with('branches', 'branches.leaves')->get();

    	return view('tree', compact('list'));



    }


    public function search(Request $request){

    	if ($request->ajax()) {
	    	
	    	$trees = Tree::where('name', 'LIKE', '%'.$request->search.'%')->with('branches', 'leaves')->orderBy('id', 'ASC')->get();
	    	$branches = Branch::where('name', 'LIKE', '%'.$request->search.'%')->with('tree', 'leaves')->get();
	    	$leaves = Leaf::where('name', 'LIKE', '%'.$request->search.'%')->with('branch')->get();

	    	

	    	foreach ($leaves as $leave) {
	 	
	 			if (!($branches->contains($leave->branch))) {
	                $branches->push($leave->branch);
	            }
	    	}


	    	foreach ($branches as $branch) {
	 		
	 			if (!($trees->contains($branch->tree))) {
	                $trees->push($branch->tree);
	            }
	    	}

	    	$trees = $trees->sortBy('created_at');

	    	return view('templatetree', compact('trees', 'branches', 'leaves'));

    	}
    }
}
