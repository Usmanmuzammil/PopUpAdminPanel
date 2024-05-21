<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Bills;
use App\Models\BookerPayment;

use App\Models\OrderBooker;
use App\Models\pos_seting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
// use DataTables;
use Psy\CodeCleaner\ReturnTypePass;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{

    // summary report
    public function summary_report(){

        try{

            // $from_date = date('Y-m-d');
            // $to_date = date('Y-m-d');

                $month = date('m');
                $year = date('Y');
                $current_month = date('Y-m');


     $daily_sell = Bill::select('bill_details.product_id', DB::raw('SUM(bill_details.qty) as total_qty'))
     ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
     ->whereMonth('bills.date', $month)->whereYear('bills.date',$year)
     ->groupBy('bill_details.product_id')
     ->get();

            $orders =  Bill::whereMonth('date',$month)->whereYear('date',$year);
            $payments = BookerPayment::whereMonth('date',$month)->whereYear('date',$year)->sum('amount');

           $total_dining = DB::table('bills')
            ->whereMonth('date', $month)->whereYear('date',$year)

            ->where('order_type','dining')

            ->count();
            $total_delivery = DB::table('bills')
            ->whereMonth('date', $month)->whereYear('date',$year)
            ->where('order_type','delivery')
            ->count();
            $total_parcel = DB::table('bills')
            ->whereMonth('date', $month)->whereYear('date',$year)

            ->where('order_type','parcel')
            ->count();
            $total_takaway = DB::table('bills')
            ->whereMonth('date', $month)->whereYear('date',$year)
            ->where('order_type','take_away')
            ->count();

            $BookerPayments = BookerPayment::select('booker_id', DB::raw('SUM(amount) as total_amount'))
            ->whereMonth('date', $month)->whereYear('date',$year)
            ->whereNull('deleted_at')
            ->groupBy('booker_id')
            ->get();


            return view('reports.summary',compact('daily_sell','current_month','orders','payments','total_dining','total_delivery','total_parcel','total_takaway','BookerPayments'));

        }catch(Exception $ex){
            return $ex->getMessage();
            return redirect()->back()->with('error',$ex->getMessage());
        }
        return view('reports.summary');
    }

    public function get_summary_report(Request $req){

       $m = $req->month;
        $month = date('m',strtotime($m));
        $year = date('Y',strtotime($m));

        try{



     $daily_sell = Bill::select('bill_details.product_id', DB::raw('SUM(bill_details.qty) as total_qty'))
     ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
     ->whereMonth('bills.date', $month)->whereYear('bills.date',$year)
     ->groupBy('bill_details.product_id')
     ->get();



            $orders =  Bill::whereMonth('date',$month)->whereYear('date',$year);


            $payments = BookerPayment::whereMonth('date',$month)->whereYear('date',$year)->sum('amount');

           $total_dining = DB::table('bills')
            ->whereMonth('date',$month)->whereYear('date',$year)
            ->where('order_type','dining')
            ->count();
            $total_delivery = DB::table('bills')
            ->whereMonth('date',$month)->whereYear('date',$year)
            ->where('order_type','delivery')
            ->count();
            $total_parcel = DB::table('bills')
            ->whereMonth('date',$month)->whereYear('date',$year)
            ->where('order_type','parcel')
            ->count();
            $total_takaway = DB::table('bills')
            ->whereMonth('date',$month)->whereYear('date',$year)
            ->where('order_type','take_away')
            ->count();

            $BookerPayments = BookerPayment::select('booker_id', DB::raw('SUM(amount) as total_amount'))
            ->whereMonth('date',$month)->whereYear('date',$year)
            ->whereNull('deleted_at')
            ->groupBy('booker_id')
            ->get();

            if($req->has('print')){
                return view('reports.print.summary',compact('daily_sell','m','orders','payments','total_dining','total_delivery','total_parcel','total_takaway','BookerPayments'));

            }

            return view('reports.summary',compact('daily_sell','m','orders','payments','total_dining','total_delivery','total_parcel','total_takaway','BookerPayments'));

        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
        return view('reports.summary');
    }



public function orderBookerReport(){
    $bookers = OrderBooker::all();

    return view('reports.booker',compact('bookers'));

}

public function getBookerReport(Request $req){
    try{


        $id = $req->booker;
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $obj =new OrderBooker();

        $bookers = $obj::all();
        $payments = BookerPayment::whereBetween('date',[$from_date,$to_date])->where('booker_id',$id)->get();
       $orders = Bill::whereBetween('date',[$from_date,$to_date])->where('booker_id',$id)->get();
      $balance =  $obj->getBalance($id);
            if($req->has('print')){
                return view('reports.print.booker',compact('bookers','orders','payments','from_date','to_date','id','balance'));

            }
            return view('reports.booker',compact('bookers','orders','payments','from_date','to_date','id','balance'));

    }catch(Exception $ex){
        return $ex->getMessage();
        return redirect()->back()->with('error',$ex->getMessage());
    }


}



public function dateReport (Request $req){


try {
    $date = date('Y-m-d');
    if ($req->has('date')) {
        $date = $req->date;
    }

    $posSetting = pos_seting::where('date', $date)->latest('id')->first();

    if(!$posSetting){
    return view('reports.daily');

    }

    $sells = Bill::where('created_at','>=',$posSetting->created_at)->where('created_at','<=',$posSetting->closing_date)->get();



     $daily_sell = Bill::select('bill_details.product_id', DB::raw('SUM(bill_details.qty) as total_qty'))
    ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
    ->where('bills.created_at', '>=', $posSetting->created_at)
    ->where('bills.created_at', '<=', $posSetting->closing_date)
    ->groupBy('bill_details.product_id')
    ->get();


    $sells = $sells->sum('net_total');



    $bookers = OrderBooker::all();

    return view('reports.daily', compact('sells','bookers','date','daily_sell'));
} catch (\Exception $e) {

    return view('reports.daily');
}




}
}