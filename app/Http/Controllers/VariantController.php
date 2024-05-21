<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $variant=variant::where('user_id',$user_id)->get();
        return view('variant.index',compact('variant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $user_id=Auth::user()->id;
            $variant=new variant;
            $variant->name=$request->name;
            $variant->user_id=$user_id;
            $variant->value=1;
            $save=$variant->save();
            if($save){
                return redirect('/variant')->with('message','variant added');
            }else{
                return view('variant.create');
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
        $variant=variant::where('id',$id)->get();
        return view('variant.edit',compact('variant'));
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
        if($req->has('value') && $req->value=='on'){
            $value=1;
        }else{
            $value=0;
        }
        $validate=$req->validate([
            'name'=>'required'
        ]);
        if($validate){
            $update=DB::table('variants')->where('id',$id)->update([
                'name'=>$req->name,
                'value'=>$value
            ]);
            if($update){
                return redirect('/variant')->with('message',"variant update");
            }else{
                return redirect('/variant');
            }
        }
        return 'update';
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
