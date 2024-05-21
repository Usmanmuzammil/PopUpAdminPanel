<?php

namespace App\Http\Controllers;

use App\Models\tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth::user()->id;
        $tax=tax::where('user_id',$user_id)->get();
        return view('tax.index',compact('tax'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate=$req->validate([
            'name'=>'required',
            'rate'=>'required'
        ]);
        if($validate){
        
        $tax=new tax();
        $user_id=auth::user()->id;

        $tax->name=$req->name;
        $tax->user_id=$user_id;
        $tax->rate=$req->rate;
        $tax->status=1;
        $tax->save();
        return redirect('/tax')->with('message','Tax Added');
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
        $tax=tax::where('id',$id)->get();
        return view('tax.edit',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $user_id=auth::user()->id;

        if($req->has('value') && $req->value=='on'){
            $status=1;
        }else{
            $status=0;
        }

        $validate=$req->validate([
            'name'=>'required',
            'rate'=>'required'
        ]);
        if($validate){
            $update=DB::table('taxes')
            ->where('id', $id)
            ->update(['name' => $req->name,'rate'=>$req->rate,'status'=>$status]);
            if($update){
                return redirect('/tax')->with('message','tax updated');
            }else{
                return redirect('/tax');
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
        $delete=tax::where('id',$id)->delete();
        if($delete){
            return redirect('/tax')->with('message',"Tax deleted");
        }
    }
}
