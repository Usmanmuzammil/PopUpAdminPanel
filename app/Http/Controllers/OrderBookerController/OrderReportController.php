<?php

namespace App\Http\Controllers\OrderBookerController;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\pos_seting;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderReportController extends Controller
{
    public function __construct()
    {

    }
    public function report(){
        return view('order-booker-pannel.reports.index');
    }

    public function get_report(Request $req){
        $user = Auth::user();
     $date =    $req->date;

     $posSetting = pos_seting::where('date',$req->date)->first();

if($posSetting){

    $orders =  Bill::where('booker_id', $user->id)->where('created_at','>=', $posSetting->created_at)
    ->where('created_at','<=', $posSetting->closing_date)->get();


    //   $orders =   Bill::where('booker_id',$user->id)->whereBetween('date' , [$req->from_date,$req->to_date])->get();

    return view('order-booker-pannel.reports.print',compact('orders','date'));
}else{
    return redirect()->back()->with(['type'=>'danger','message'=>'no record found']);
}

    }

    // public function get_report(Request $req){
    //     $user = Auth::user();
    //  $date =    $req->date;
    //  $report_date = $req->date;

    //  $date =  pos_seting::where('date',$date)->orderBy('id','desc')->limit(1)->get();

    //   $orders =   Bill::where('booker_id',$user->id)
    //   ->where('created_at', '>=', $date[0]->created_at)
    //   ->where('created_at', '<=', $date[0]->closing_date)
    //   ->get();
    //     return view('order-booker-pannel.reports.print',compact('orders','report_date'));
    // }

}