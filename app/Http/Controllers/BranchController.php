<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
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
        if ($request->ajax()) {

            $branchAddedMsg = '';
            $branchExistsMsg = '';
            request()->validate([

                'name'=>'required|min:3',
                'tree_id'=>'required|numeric',
               
               
            ]);

            if($request->icon){
            $branch = Branch::firstOrCreate([
                            
                'name' => $request->name,
                'icon' => $request->icon,
                'tree_id'=>$request->tree_id
                            
            ]);

            }else{ $branch = Branch::firstOrCreate([
                            
                    'name' => $request->name,
                    'tree_id' => $request->tree_id
                               
                    ]);

            }
            
            if ($branch->wasRecentlyCreated) {
           
                $branchAddedMsg = 'Branch item has been added to the database';
            }else{
                $branchExistsMsg = 'Branch already exists in the database';
            }

            return response()->json([
                   
                    'success'=>$branchAddedMsg,
                    'info'=>$branchExistsMsg
                    
                ]); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
