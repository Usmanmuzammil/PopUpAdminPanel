<?php

namespace App\Http\Controllers;

// use auth;
// use auth;
use App\Models\Catagery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $category=Catagery::all();
        return view('category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name'=>'required'
        ]);
        if($validate){
            $catagery=new Catagery();
            $user_id=auth::user()->id;
            $catagery->catagery_name=$req->name;
            $catagery->user_id=$user_id;
            $saved=$catagery->save();
            if($saved){
                return redirect()->route('category.index')->with('success','category added');
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
        $category=Catagery::where('id',$id)->get();
        return view('category.edit',compact('category'));
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
            $status=1;
            // return $req->value;
        }else{
            $status=0;
        }
        $req->validate([
            'name'=>'required'
        ]);
        $update=DB::table('catageries')
            ->where('id', $id)
            ->update(['catagery_name' => $req->name,'status'=>$status]);
            if($update){
                return redirect('/category')->with('success',"category updated..!");
            }else{
                return redirect('category/'.$id.'/edit')->with('message',"no any chance found");
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
        $dlt=Catagery::where('id',$id)->delete();
        if($dlt){
            return redirect('/category')->with('message',"Category Deleted..!");
        }
    }
}
