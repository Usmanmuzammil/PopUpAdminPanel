<?php

namespace App\Http\Controllers;

// use auth;

use App\Models\Product;
use App\Models\unit;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $unit=unit::all();
        return view('unit.index',compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $check=unit::where('unit_name',$req->name)->where('code',$req->unitCode)->exists();
        if($check){
            return back()->with('danger',"This Unit Already Exists");
        }
        $validate=$req->validate([
            'name'=>'required',
            'unitCode'=>'required',

        ]);
        if($validate){

        $unit=new unit();
        $user_id=auth::user()->id;
        $unit->code=$req->unitCode;
        $unit->unit_name=$req->name;

        $unit->user_id=$user_id;
        $save=$unit->save();
        if($save){
            return redirect()->route('unit.store')->with('success','Unit Added Successfully..');
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
        $unit=unit::where('id',$id)->get();
        return view('unit.edit',compact('unit'));
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

        $validate=$request->validate([
            'name'=>'required',
            'unitCode'=>'required'
        ]);
        if($validate){
        DB::table('units')
            ->where('id', $id)
            ->update(['unit_name' => $request->name,'code'=>$request->unitCode]);
            return redirect('/unit')->with('success',"Unit Updated Successfully");
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
        $count= Product::where('unit_id',$id)->count();
        if($count>0){
          return redirect()->back()->with(['danger'=>'This Unit has many product so cant delete this...!','type'=>'danger']);
        }

       $delete= unit::find($id)->delete();
       if($delete){
        return redirect()->route('unit.index')->with(['danger'=>'Unit Deleted Successfully..!','type'=>'danger']);
       }
    }
}
