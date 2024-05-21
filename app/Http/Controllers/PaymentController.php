<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payments;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $payment= Payments::all();
       return view('payments.index',compact('payment'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $from_account=Account::all();
        $to_account=Account::all();

        return view('payments.create',compact('from_account','to_account'));
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
            'from_account'=>'required',
            'to_account'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'desc'=>'max:255|required'
        ]);

        if($validate){
            $payment=new Payments();
            $payment->from_account=$req->from_account;
            $payment->to_account=$req->to_account;
            $payment->date=$req->date;
            $payment->amount=$req->amount;
            $payment->desc=$req->desc ?? "";
            $payment->status=1;
            $payment->user_id=Auth::user()->id;
            if($payment->save()){
                return redirect()->route('payment.index')->with(['message'=>'Payment added success fully....!','type'=>'success']);
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
     $from_account=   Account::all();
     $to_account=  Account::all();
    $payment= Payments::where('id',$id)->get();
    return view('payments.edit',compact('from_account','to_account','payment'));
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
        $validate=$req->validate([
            'from_account'=>'required',
            'to_account'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'desc'=>'max:255|required'
        ]);

        if($validate){
            $payment=Payment::where('id',$id)->first();
            $payment->from_account=$req->from_account;
            $payment->to_account=$req->to_account;
            $payment->date=$req->date;
            $payment->amount=$req->amount;
            $payment->desc=$req->desc ?? "";
            $payment->status=1;
            $payment->user_id=Auth::user()->id;
            if($payment->save()){
                return redirect()->route('payment.index')->with(['message'=>'Payment updated success fully....!','type'=>'success']);
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
      $delete=  Payments::find($id)->delete();
      if($delete){
        return redirect()->route('payment.index')->with(['message'=>'Payment delete success fully....!','type'=>'success']);

      }
      
    }
}
