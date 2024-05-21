<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}

    function index(){
        // return "";
        $expense=Expense::orderBy('date','desc')->get();

        return view('expense.index',compact('expense'));
    }
    function create(){

        $account=Account::where('account_type','shop-account')->get();
        return view('expense.create',compact('account'));

    }
    function store(Request $req){
        $validate=$req->validate([
            'date'=>'required',
            
            'amount'=>'integer|required',
        ]);
        if($validate){
            $account = Account::where('status','default')->first();
            $expense=new Expense();
            $expense->date=$req->date;
            $expense->amount=$req->amount;
            $expense->desc=$req->desc;
            $expense->pay_account_id=$account->id;
        if($expense->save()){
            return redirect()->route('expense.list')->with('message','expense added successfull');
        }

        }


    }
    function edit($id){
        $expense=Expense::where('id',$id)->get();
        // return "work";
        $account=Account::where('account_type','shop-account')->get();
        return view('expense.edit',compact('expense','account'));


    }

    public function update(Request $req, $id)
    {
        $validate=$req->validate([
            'date'=>'required',
            'amount'=>'integer|required',

        ]);
        if($validate){
            $account = Account::where('status','default')->first();
            $expense=Expense::find($id);
            $expense->date=$req->date;
            $expense->amount=$req->amount;
            $expense->desc=$req->desc;
            $expense->pay_account_id=$account->id;
        if($expense->save()){
            return redirect()->route('expense.list')->with('message','expense updated successfull');
        }

        }
    }
    function destory($id){
        $expense=Expense::find($id);
        $expense->delete();
        if($expense){


        return redirect()->route('expense.list')->with('message',"Expense Deleted Successfull");
        }else{
        return redirect()->route('expense.list')->with('message',"Expense Not Deleted");

        }

    }
}
