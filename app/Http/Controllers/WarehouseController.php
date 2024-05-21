<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth::user()->id;
        $warehouse=warehouse::where('user_id',$user_id)->get();
        return view('warehouse.index',compact('warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=warehouse::where('name',$request->name)->get();
        if(!empty($check)){
            return back()->with('message','Warehouse already added with this name');
        }
        $validate=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|digits:11',
            'address'=>'required'
        ]);
        if($validate){
        
        
        $warehouse=new warehouse();
        $user_id=auth::user()->id;
        $warehouse->name=$request->name;
        $warehouse->email=$request->email;
        $warehouse->phone=$request->phone;
        $warehouse->address=$request->address;
        $warehouse->user_id=$user_id;
        $save=$warehouse->save();
        if($save){
            return redirect('/warehouse');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $warehouse= warehouse::where('id',$id)->get();
        return view('warehouse.edit',compact('warehouse'));
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
        $update=DB::table('warehouses')
            ->where('id', $id)
            ->update(['name' => $request->name,'email'=>$request->email,'phone'=>$request->phone,'address'=>$request->address]);
            if($update){
            return redirect('/warehouse')->with('message',"warehouse updated");
            }else{
            return redirect('/warehouse/'.$id.'/edit')->with('message',"no any changes found");
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
        $delete=warehouse::where('id',$id)->delete();
        if($delete){
            return redirect('/warehouse')->with('message',"warehouse deleted");
        }
    }
}
