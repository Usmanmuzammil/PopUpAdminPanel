<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Account;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Payments;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Purchase;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

        public function getData(Request $req)
        {
            $period = $req->input('period');
            switch ($period) {
                case 'today':
                    $start= date('Y-m-d');
                    $end= date('Y-m-d');
                    // $expense =Expense::where('date',$today)->sum('amount');
                    break;
                case 'week':
                    $today = Carbon::today();

                    // Get the date from 7 days ago
                    $start = $today->copy()->subDays(7)->startOfDay();

                    // Get the end of today
                    $end = $today->copy()->endOfDay();

                    // return $end . "/" . $start;
                    break;
                case 'month':
                    $start = Carbon::now()->startOfMonth();
                    $end = Carbon::now()->endOfMonth();
                    break;
                case 'year':
                    $start = Carbon::now()->startOfYear();
                    $end = Carbon::now()->endOfYear();
                    break;
            }


            $account = new Account();
           $total_sale = Bill::whereBetween('date', [$start, $end])->where('bill_type','sell')->sum('net_total');
          
           $total_purchase = Purchase::whereBetween('date', [$start, $end])->sum('total_amount');
           $total_expense = Expense::whereBetween('date', [$start, $end])->sum('amount');
           $total_profit = DB::table('bills as b')->join('bill_details as bd', 'b.id', '=', 'bd.bill_id')->join('products as p', 'bd.product_id', '=', 'p.id')->where('b.bill_type', '=', 'sell')->whereBetween('b.date', [$start, $end])->selectRaw('sum((bd.price - p.purchase_price) * bd.qty) as aggregate')->value('aggregate');
           $you_will_pay = $this->getPayBalance();
           $you_will_receive =  $this->getReceiveBalance();
           $balance  = $account->getDefaultAccountBalance();
            $boss_balance =0;

        //    return $total_expense;
            return response()->json([
                'total_sale' => $total_sale ,
                'total_purchase' => $total_purchase ,
                'total_expense'=>  $total_expense,
                'total_profit' => $total_sale,
                'you_will_pay' => $you_will_pay,
                'you_will_receive'=> $you_will_receive,
                'balance'=> $balance,
                'boss_balance'=>$boss_balance
            ]);
        }

    public function getPayBalance(){
    $account = Account::where('account_type','purchaser')->get();
    $balance = $account->sum('opening_balance');
    $rem = Purchase::all();

    $remaining =$rem->sum('remaining'); 
    $send = Payment::where('payment_type', 'send')->sum('amount');
    return ($balance+$remaining)-$send;
    }

    public function getReceiveBalance(){
        $account = Account::where('account_type', 'customer')->get();
      $balance =  $account->sum('opening_balance');
        $bill = Bill::all();
      $remaining = $bill->sum('remaining');
        $receive = Payment::where('payment_type', 'receive')->sum('amount');
        return  ($balance+$remaining)-$receive;
        }

}
