<?php

namespace App\Http\Controllers;


use App\Branch;
use App\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
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
        $trees = Tree::with('branches')->get();
        
        // dd($trees);  
       
        return view('createtree', compact('trees'));
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

            $treeAddedMsg = '';
            request()->validate([

                'name'=>'required|unique:trees|min:3',
               
               
            ]);

            if($request->icon){
            $tree = Tree::firstOrCreate([
                            
                'name' => $request->name,
                'icon' => $request->icon
                            
            ]);

        }else{
             $tree = Tree::firstOrCreate([
                            
                'name' => $request->name,
                               
            ]);

        }

            if ($tree->wasRecentlyCreated) {
           
                $treeAddedMsg = 'Tree item has been added to the database';
            }

            return response()->json([
                   
                    'success'=>$treeAddedMsg
                    
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
