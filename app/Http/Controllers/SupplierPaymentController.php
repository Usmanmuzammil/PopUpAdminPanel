<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::where('payment_type','send')->get();
        return view('purchase.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::where('account_type','=','purchaser')->orderBy('account_type','asc')->orderBy('name','asc')->get();
        $shop_accounts = Account::where('account_type','shop-account')->orderBy('name','asc')->get();
        return view('purchase.payments.create',compact('accounts','shop_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
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
        $payment->description = $request->description;

            $payment->user_id=Auth::user()->id;
            $payment->save();

        //    Payment::create(array_merge($request->all(), ['user_id'=>Auth::user()->id]));
        return redirect()->route('supplier_payment.index')->with('success','Payment Added Successfully');
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

        $accounts = Account::where('account_type','purchaser')->get();
        $shop_accounts = Account::where('account_type','shop-account')->get();
        $payment_data = Payment::find($id);
        return view('purchase.payments.edit',compact('payment_data','accounts','shop_accounts'));
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
        return redirect()->route('supplier_payment.index')->with('success','Payment Updated Successfully...');

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

        return redirect()->route('supplier_payment.index')->with('success','Payment Deleted Successfully...');

    }


 public function invoice(Request $req , $id=null){
$supplier ="";
$sup_id  = "";
$from_date = $req->from_date;
       $to_date = $req->to_date;

    if($req->has('submit')){
        // $
        $sup_id=$req->sup_id;
        $from_date = $req->from_date;
       $to_date = $req->to_date;

        // $supplier = Account::with(['getSupplierPayments' => function ($query) use ($req) {
        //     $query->whereBetween('date', [$req->from_date, $req->to_date]);
        // }])
        // ->where('id', $sup_id)
        // ->get();
        $account=Account::where('id',$sup_id)->first();
        
        $payments = Payment::select('account_id', 'date', DB::raw('SUM(amount) as total_amount'))
        ->whereBetween('date', [$req->from_date, $req->to_date])
        ->groupBy('account_id', 'date')
        ->where('account_id',$sup_id)
        ->get();

        
        return view('purchase.payments.print',compact('account','payments','sup_id','from_date','to_date'));
    

    }
    if($req->has('print')){
        $sup_id=$req->sup_id;
        $account=Account::where('id',$sup_id)->first();
        
        $payments = Payment::select('account_id', 'date', DB::raw('SUM(amount) as total_amount'))
        ->whereBetween('date', [$req->from_date, $req->to_date])
        ->groupBy('account_id', 'date')
        ->where('account_id',$sup_id)
        ->get();

        
        return view('purchase.payments.payment-print',compact('account','payments','sup_id','from_date','to_date'));

    }

        // $
          $sup_id=$id;
        
    $account=Account::where('id',$sup_id)->first();
    $purchase_amount = Purchase::where('supplier_id',$sup_id)->sum('total_amount');
        
        // $payments = Payment::select('account_id', 'date', DB::raw('SUM(amount) as total_amount'))
        // ->whereBetween('date', [$req->from_date, $req->to_date])
        // ->groupBy('account_id', 'date')
        // ->where('account_id',$sup_id)
        // ->get();
        
        $payment_amount = Payment::where('account_id',$sup_id)->sum('amount');

        return view('purchase.payments.ledger',compact('account','purchase_amount','payment_amount','sup_id','account'));
    
        

        
 
 }
//  supplier purchase  invoices 
public function get_supplier_ledger_invoices($id,$startDate,$endDate){

       
    $purchase = Purchase::
    where('supplier_id', $id)
    ->whereBetween('date', [$startDate, $endDate])->orderBy('id','desc');
    return  datatables($purchase)->make('true');
}
public function get_supplier_ledger_payments($id,$startDate,$endDate){

    $purchase = Payment::with('getShopAccountName')->where('account_id', $id)
    ->where('payment_type','send')->orderBy('id','desc')
    ->whereBetween('date', [$startDate, $endDate]);
    return  datatables($purchase)->make('true');
}
// public function print_supplier_report(Request $request, $id) {
//     $fromDate = $request->selectedStartDate;
//     $toDate = $request->selectedEndDate;

//     $account = Account::where('id',$id)->first();
//     // $datesInRange = DB::table('purchases')
//     //     ->select('date')
//     //     ->whereBetween('date', [$fromDate, $toDate])
//     //     ->where('supplier_id', $id)
//     //     ->union(DB::table('payments')
//     //         ->select('date')
//     //         ->whereBetween('date', [$fromDate, $toDate])
//     //         ->where('account_id', $id))
//     //     ->distinct()
//     //     ->orderBy('date')
//     //     ->pluck('date');

//     // $report = collect();

//     // foreach ($datesInRange as $date) {
//     //     $purchaseAmount = DB::table('purchases')
//     //         ->where('supplier_id', $id)
//     //         ->where('date', $date)
//     //         ->sum('total_amount');
//     //         $purchasePaidAmount = DB::table('purchases')
//     //         ->where('supplier_id', $id)
//     //         ->where('date', $date)
//     //         ->sum('paid_amount');
//     //         $purchaseRemAmount = DB::table('purchases')
//     //         ->where('supplier_id', $id)
//     //         ->where('date', $date)
//     //         ->sum('remaining');


//     //     $paymentAmount = DB::table('payments')
//     //         ->where('account_id', $id)
//     //         ->where('date', $date)
//     //         ->sum('amount');

//     //    $report->push([
//     //         'date' => $date,
//     //         'purchase_amount' => $purchaseAmount,
//     //         'purchase_paid'   => $purchasePaidAmount,
//     //         'purchase_rem'    =>$purchaseRemAmount,
//     //         'payment_amount' => $paymentAmount,
//     //     ]);
        
//     // }
//     // return $report = DB::table('accounts')
//     // ->select('purchases.date', 'purchases.total_amount', 'purchases.paid_amount', 'purchases.remaining', 'payments.amount as payment_amount')
//     // ->leftJoin('purchases', function ($join) use ($fromDate, $toDate) {
//     //     $join->on('accounts.id', '=', 'purchases.supplier_id')
//     //         ->whereBetween('purchases.date', [$fromDate, $toDate]);
//     // })
//     // ->leftJoin('payments', function ($join) use ($fromDate, $toDate) {
//     //     $join->on('accounts.id', '=', 'payments.account_id')
//     //         ->whereBetween('payments.date', [$fromDate, $toDate]);
//     // })
//     // ->where('accounts.id', $id)
//     // ->orderBy('purchases.date')
//     // ->get();
//         $report = Purchase::where('supplier_id',$id)->whereBetween('date',[$fromDate,$toDate])->orderBy('date','asc')->get();
//        $payment =  Payment::where('account_id',$id)->where('payment_type','send')->whereBetween('date',[$fromDate,$toDate])->get();
//         return view('purchase.payments.print',compact('account','report','fromDate','toDate','payment'));
// }
public function print_supplier_report(Request $request, $id) {
    $fromDate = $request->selectedStartDate;
    $toDate = $request->selectedEndDate;
    $account = Account::where('id', $id)->first();

    $report = DB::table('accounts')
        ->select(
            'purchases.date',
            'purchases.total_amount',
            'purchases.paid_amount',
            'purchases.remaining',
            DB::raw("'purchase' as type"),
            DB::raw("'purchase' as purchase_type"),
            DB::raw('0 as payment_amount') // Add this line for payment amount
        )
        ->leftJoin('purchases', function ($join) use ($fromDate, $toDate) {
            $join->on('accounts.id', '=', 'purchases.supplier_id')
                ->whereBetween('purchases.date', [$fromDate, $toDate]);
        })
        ->where('accounts.id', $id)
        ->unionAll(DB::table('payments')
            ->select(
                'payments.date',
                DB::raw('0 as total_amount'),
                DB::raw('0 as paid_amount'),
                DB::raw('0 as remaining'),
                DB::raw("'payment' as type"),
                DB::raw("'' as purchase_type"),
                'payments.amount as payment_amount' // Include payment amount
            )
            ->whereBetween('payments.date', [$fromDate, $toDate])
            ->where('payments.account_id', $id))
        ->orderBy('date')
        ->get();

    $totalAmount = $report->sum('total_amount');
    $totalPaid = $report->sum('paid_amount');
    $totalRem = $report->sum('remaining');
    $totalPayment = $report->sum('payment_amount');
    
    return view('purchase.payments.print', compact('account', 'report', 'fromDate', 'toDate', 'totalAmount', 'totalPaid', 'totalRem', 'totalPayment'));
}




}
