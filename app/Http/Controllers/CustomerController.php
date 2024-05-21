<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Account;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
     public function index()
     {
         $customers=Account::where('account_type','customer')->get();
         return view("sell.customer.index",compact('customers'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view("sell.customer.create");
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
             'opening_balance'=>'required',
         ]);
         if($validate){
             $account=new Account();
            $user_id= Auth::user()->id;
             $account->account_type="customer";
             $account->name=ucfirst($req->name);
             $account->phone=$req->phone;
             $account->opening_balance=$req->opening_balance;
             $account->user_id=$user_id;
             $save=$account->save();
             if($save){
                 return redirect()->back()->with('message',"Customers Created Successfully..!");
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
     
         $customers=Account::where('id',$id)->get();
      return view('sell.customer.edit',['customers'=>$customers]);
     }
 
    
     public function update(Request $req, $id)
     {
         $validate=$req->validate([
             'name'=>'required',
             'opening_balance'=>'required',
         ]);
         if($validate){
             $update=DB::table('accounts')->where('id',$id)->update([
                 'name'=>$req->name,
                 'phone'=>$req->phone,
                 'opening_balance'=>$req->opening_balance,
                 'user_id'=>Auth::user()->id,
             ]);
             if($update){
                 return redirect('/customers')->with('message',"Customer Updated Successfully");
             }else{
                 return redirect('/customers/create');
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

        $account =  Account::find($id);
        if($account->account_type=='customer'){
            $count =Bill::where('account_id',$id)->count();
            
                $billIds=   Bill::where('account_id',$id)->pluck('id');
                DB::table('bill_details')
                ->whereIn('bill_id', $billIds)
                ->delete();
                $count=   Bill::where('account_id',$id)->delete();
                Payment::where('account_id',$id)->where('payment_type','receive')->delete();
                if($account->delete()){
                    return redirect()->back()->with(['message'=>' customer deleted successfully..!','type'=>'success']);

            
            }
     
        }
      


    } 
 
 
 
 
}
