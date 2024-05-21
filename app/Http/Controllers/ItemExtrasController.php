<?php

namespace App\Http\Controllers;

use App\Models\item_extras;
use Illuminate\Http\Request;

class ItemExtrasController extends Controller
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
      $validate =   $request->validate([
            'name'=>'required',
            'price'=>'required',
            'item_id'=>'required'
        ]);
        if($validate){
            $item_extra =new item_extras();
            $item_extra->name=$request->name;
            $item_extra->price=$request->price;
            $item_extra->item_id=$request->item_id;
            if($item_extra->save()){
            return redirect()->back()->with('success','Item extra added successfully');
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
            'name'=>'required',
            'price'=>'required',
            'item_id'=>'required'
        ]);
        if($validate){
            $item_extra =item_extras::find($id);
            $item_extra->name=$request->name;
            $item_extra->price=$request->price;
            $item_extra->item_id=$request->item_id;
            if($item_extra->save()){
            return redirect()->back()->with('success','Item extra updated successfully');
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
        if(item_extras::find($id)->delete()){
            return redirect()->back()->with('success','Item extra deleted successfully');
        }
    }
}
