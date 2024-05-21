<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::where('payment_type','receive')->get();
        return view('sell.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::where('account_type','=','customer')->orderBy('account_type','asc')->orderBy('name','asc')->get();
        $shop_accounts = Account::where('account_type','shop-account')->orderBy('name','asc')->get();
        return view('sell.payments.create',compact('accounts','shop_accounts'));
    }

    public function store(Request $request)
    {
        $validate=$request->validate([
            'date'=>'required',
            'account_id'=>'required',
            'shop_account_id'=>'required',
            'amount'=>'required',
            'payment_type'=>'required',
        ]);


        if($validate){
         
            $payment=new Payment();
           
            $payment->date=$request->date;
            $payment->account_id=$request->account_id;
            $payment->shop_account_id=$request->shop_account_id;
            $payment->amount=$request->amount;
            $payment->payment_type=$request->payment_type;
            $payment->user_id=Auth::user()->id;
            $payment->save();  
            return redirect()->route('customer_payment.index')->with('success','Payment Added Successfully');
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

        $accounts = Account::where('account_type','customer')->get();
        $shop_accounts = Account::where('account_type','shop-account')->get();
        $payment_data = Payment::find($id);
        return view('sell.payments.edit',compact('payment_data','accounts','shop_accounts'));
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
        'date'=>'required',
        'account_id'=>'required',
        'shop_account_id'=>'required',
        'amount'=>'required',
    ]);


    if($validate){
        
       $payment =  Payment::find($id);
        $payment->account_id = $request->account_id;
        $payment->shop_account_id = $request->shop_account_id;
        $payment->amount = $request->amount;
        $payment->description = $request->description;
        $payment->date = $request->date;
        $payment->user_id = Auth::user()->id;
        $payment->save();
    }
        return redirect()->route('customer_payment.index')->with('success','Payment Updated Successfully...');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::where('id',$id)->delete();

        return redirect()->route('customer_payment.index')->with('success','Payment Deleted Successfully...');

    }
    public function invoice(Request $req ,$id=null){
        
         $customer ="";
            $cust_id  = "";

    
    $cust_id=$id;
        
    $account=Account::where('id',$cust_id)->first();
    $bill_amount = Bill::where('account_id',$cust_id)->sum('net_total');
        
        // $payments = Payment::select('account_id', 'date', DB::raw('SUM(amount) as total_amount'))
        // ->whereBetween('date', [$req->from_date, $req->to_date])
        // ->groupBy('account_id', 'date')
        // ->where('account_id',$sup_id)
        // ->get();
        
        $payment_amount = Payment::where('account_id',$cust_id)->sum('amount');        
    return view('sell.payments.legder',compact('account','bill_amount','payment_amount','cust_id'));
         
         
      }


   

public function get_customer_ledger_invoices($id,$startDate,$endDate){

       
    $sale = Bill::
    where('account_id', $id)
    ->whereBetween('date', [$startDate, $endDate])->orderBy('id','desc');
    return  datatables($sale)->make('true');
}
public function get_customer_ledger_payments($id,$startDate,$endDate){

    $purchase = Payment::with('getShopAccountName')->where('account_id', $id)
    ->where('payment_type','receive')->orderBy('id','desc')
    ->whereBetween('date', [$startDate, $endDate]);
    return  datatables($purchase)->make('true');
}

    public function print_customer_report(Request $request, $id) {
        $fromDate = $request->selectedStartDate;
        $toDate = $request->selectedEndDate;
        $account = Account::where('id', $id)->first();
    
       $report = DB::table('accounts')
   ->select(
       'bills.date',
       'bills.total',
       'bills.discount',
       'bills.net_total',
       'bills.paid_amount',
       'bills.remaining',
       DB::raw("'invoice' as type"),
       DB::raw('0 as payment_amount') // Add this line for payment amount
   )
   ->leftJoin('bills', function ($join) use ($fromDate, $toDate) {
       $join->on('accounts.id', '=', 'bills.account_id')
           ->whereBetween('bills.date', [$fromDate, $toDate]);
   })
   ->where('accounts.id', $id)
   ->unionAll(DB::table('payments')
       ->select(
           'payments.date',
           DB::raw('0 as total'),
           DB::raw('0 as discount'),
           DB::raw('0 as net_total'),
           DB::raw('0 as paid_amount'),
           DB::raw('0 as remaining'),
           DB::raw("'payment' as type"),
           'payments.amount as payment_amount' // Include payment amount
       )
       ->whereBetween('payments.date', [$fromDate, $toDate])
       ->where('payments.account_id', $id))
   ->orderBy('date')
   ->get();

$totalAmount = $report->sum('total');
$totalDiscount = $report->sum('discount');
$totalNetTotal = $report->sum('net_total');
$totalPaid = $report->sum('paid_amount');
$totalRem = $report->sum('remaining');
$totalPayment = $report->sum('payment_amount');

return view('sell.payments.print', compact('account', 'report', 'fromDate', 'toDate', 'totalAmount', 'totalPaid', 'totalRem', 'totalPayment','totalDiscount','totalNetTotal'));
    }
}
