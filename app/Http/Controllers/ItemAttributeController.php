<?php

namespace App\Http\Controllers;

use App\Models\item_attribute;
use Illuminate\Http\Request;

class ItemAttributeController extends Controller
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
            'name'=>'required',
            'price'=>'required',
            'item_id'=>'required',
            'attribute_id'=>'required',
        ]);
        if($validate){
        $i_attr =new     item_attribute();
        $i_attr->name = $request->name;
        $i_attr->price = $request->price;
        $i_attr->item_id = $request->item_id;
        $i_attr->attribute_id = $request->attribute_id;
        $i_attr->description = $request->description;
        if($i_attr->save()){
            return redirect()->back()->with('success','Item Variantion Added Successfully..!');
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
            'name'=>'required',
            'price'=>'required',
            'item_id'=>'required',
            'attribute_id'=>'required',
        ]);
        if($validate){
        $i_attr =item_attribute::find($id);
        $i_attr->name = $request->name;
        $i_attr->price = $request->price;
        $i_attr->item_id = $request->item_id;
        $i_attr->attribute_id = $request->attribute_id;
        $i_attr->description = $request->description;
        if($i_attr->save()){
            return redirect()->back()->with('success','Item Variantion Updated Successfully..!');
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
     $delete =    item_attribute::find($id)->delete();
     if($delete){
        return redirect()->back()->with('success','Variant deleted successFully..!');
     }
    }
}
