<?php

namespace App\Http\Controllers;

use App\Models\attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $attr=  attribute::whereNull('deleted_at')->get();
        return view('attribute.index',compact('attr'));
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
        'attribute_name'=>'required'
     ]);
     if($validate){
       $attr =new  attribute();
        $attr->name=$request->attribute_name;
        $attr->status=$request->status;
        
       if($attr->save()){
        return redirect()->back()->with('success','Attribute added successfully');
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
            'attribute_name'=>'required'
         ]);
         if($validate){
           $attr =attribute::find($id);
            $attr->name=$request->attribute_name;
            $attr->status=$request->status;
            
           if($attr->save()){
            return redirect()->back()->with('success','Attribute updated successfully');
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
