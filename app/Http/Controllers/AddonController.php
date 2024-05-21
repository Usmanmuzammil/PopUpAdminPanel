<?php

namespace App\Http\Controllers;

use App\Models\addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $addon =  addon::whereNull('deleted_at')->get();
       return view('addons.index',compact('addon'));
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
      $validate =   $request->validate([
            'addon_name'=>'required',
            'price'=>'required'
        ]);
        if($validate){
            $addon =new addon();
            $addon->name = $request->addon_name;
            $addon->price = $request->price;
            if($addon->save()){
                return redirect()->back()->with('success','Addon added successfully..!');
            }
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
         $validate =   $request->validate([
            'addon_name'=>'required',
            'price'=>'required'
        ]);
        if($validate){
            $addon =addon::find($id);
            $addon->name = $request->addon_name;
            $addon->price = $request->price;
            if($addon->save()){
                return redirect()->back()->with('success','Addon updated successfully..!');
            }
        }   
        
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
