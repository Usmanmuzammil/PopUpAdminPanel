<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;

class TransactionController extends Controller
{

    function index(){
        $transaction=Transaction::all();
        return view('transaction.index',compact('transaction'));
    }
function create(){
 $account=   Account::where('account_type','shop-account')->get();
 $to_account=   Account::where('account_type','shop-account')->get();

    return view('transaction.create',compact('account','to_account'));
}
function store(Request $req){
    $validate=$req->validate([
        'from_account'=>['required'],
        'to_account'=>['required'],
        'amount'=>['required','numeric','max_digits:11'],
        'desc'=>['nullable','max:255'],
        'date'=>['required','date'],
    ]);
    if($validate){
        $t=new Transaction();
        $t->from_account=$req->from_account;
        $t->to_account=$req->to_account;
        $t->date=$req->date;
        $t->amount=$req->amount;
        $t->desc=$req->desc;
        $t->user_id=Auth::user()->id;
        $t->status=1;
    if($t->save()){
        return redirect()->route('transaction.invoice',$t->id);
    }

    }
}

public function edit($id){

  $t=  Transaction::where('id',$id)->get();
  $account=   Account::where('account_type','shop-account')->get();
 $to_account=   Account::where('account_type','shop-account')->get();

  return view('transaction.edit',compact('t','account','to_account'));
}


public function update(Request $req,$id){
    $validate=$req->validate([
        'from_account'=>['required'],
        'to_account'=>['required'],
        'amount'=>['required','numeric','max_digits:11'],
        'desc'=>['nullable','max:255'],
        'date'=>['required','date'],
    ]);
    if($validate){
        $t=Transaction::find($id);
        $t->from_account=$req->from_account;
        $t->to_account=$req->to_account;
        $t->date=$req->date;
        $t->amount=$req->amount;
        $t->desc=$req->desc;
        $t->user_id=Auth::user()->id;
        $t->status=1;
    if($t->save()){

        return redirect()->route('transaction.index')->with(['success'=>'Transaction Updated Successfully..!','type'=>'success']);
    }

    }
}


public function destroy($id){
$delete=Transaction::find($id)->delete();
if($delete){
return redirect()->route('transaction.index')->with(['danger'=>'Transcation Deleted Successfully...!','type'=>'success']);
}
}

function getAccount(Request $req){
    $result=Account::where('account_type',$req->acc_type)->get();
    $output="";
    foreach ($result as $key => $value) {
        $output.="<option value=".$value->id.">".$value->name."</option>";
    }

return response()->json($output);
}

public function get_account($ac_type){
$account=Account::where('account_type',$ac_type)->get();
$output="";
if(count($account)>0){
foreach ($account as $key => $account) {
    $output.="
    <option value='".$account->id."'>".$account->name."</option>
    ";
}
}
return response()->json(['result'=>$output]);

}


public function invoice($id){

    $trs=Transaction::where('id',$id)->get();
    return view('transaction.invoice',compact('trs'));
}


}
