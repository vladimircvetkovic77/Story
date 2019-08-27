<?php

namespace App\Http\Controllers;

use App\Leaf;
use Illuminate\Http\Request;

class LeafController extends Controller
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

            $leafAddedMsg = '';
            $leafExistsMsg = '';

            request()->validate([

                'name'=>'required|min:3',
                'branch_id'=>'required|numeric',
               
               
            ]);

            if($request->icon){
                $leaf = Leaf::firstOrCreate([
                            
                'name' => $request->name,
                'icon' => $request->icon,
                'branch_id'=>$request->branch_id
                            
                ]);

            }else{ $leaf = Leaf::firstOrCreate([
                            
                    'name' => $request->name,
                    'branch_id' => $request->branch_id
                               
                    ]);

            }
            
            if ($leaf->wasRecentlyCreated) {
           
                $leafAddedMsg = 'Leaf item has been added to the database';
            }else{
                $leafExistsMsg = 'Leaf already exists in the database';
            }

            return response()->json([
                   
                    'success'=>$leafAddedMsg,
                    'info'=>$leafExistsMsg
                    
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
