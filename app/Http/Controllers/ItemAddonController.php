<?php

namespace App\Http\Controllers;

use App\Models\item_addon;
use Illuminate\Http\Request;

class ItemAddonController extends Controller
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
        $validate = $request->validate([
            'addon_id'=>'required',
            'item_id'=>'required'
        ]);
        if($validate){
           $addon = new item_addon();
           $addon->item_id=$request->item_id;
           $addon->addon_id=$request->addon_id;
           if($addon->save()){
            return redirect()->back()->with('success','Item addon added successfully');
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
        $validate = $request->validate([
            'addon_id'=>'required',
            'item_id'=>'required'
        ]);
        if($validate){
           $addon = item_addon::find($id);
           $addon->item_id=$request->item_id;
           $addon->addon_id=$request->addon_id;
           if($addon->save()){
            return redirect()->back()->with('success','Item addon update successfully');
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
