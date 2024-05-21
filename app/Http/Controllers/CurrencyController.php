<?php

namespace App\Http\Controllers;

// use auth;
use PDO;
use App\Models\currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth::user()->id;
        $currency=currency::where('user_id',$user_id)->get();
        return view('currency.index',compact('currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currency.create');
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
            'code'=>'required'
        ]);
        if($validate){
            $user_id=auth::user()->id;
            $currency=new currency();
            $currency->currency_name=$req->name;
            $currency->user_id=$user_id;
            $currency->currency_code=$req->code;
            if($currency->save()){
                 return redirect()->route('currency.index', ['currency' => 1]);
                
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
        $user_id=auth::user()->id;
        $currency=currency::where('user_id',$user_id)->get();
        return view('currency.edit',compact('currency'));
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
        if($req->has('status') && $req->status=='on'){
            $status=1;
        }else{
            $status=0;
        }
        $validate=$req->validate([
            'name'=>'required',
            'code'=>'required'
        ]);
        if($validate){
            $update=DB::table('currencies')
            ->where('id', $id)
            ->update(['currency_name' => $req->name,'currency_code'=>$req->code,'status'=>$status]);
            if($update){
                return redirect('/currency')->with('message',"currency updated");
            }else{
                return redirect('/currency');
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
