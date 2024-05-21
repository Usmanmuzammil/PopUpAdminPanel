<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable=[
        'account_type',
        'name',
        'status',
        'user_id',
        'opening_balance'
    ];


    public function getSellBill(){
       return $this->hasMany(Bill::class,'pay_account_id')->where('bill_type','sell');
    }


    public function getPurchaseBill(){
        return $this->hasMany(Bill::class,'pay_account_id')->where('bill_type','purchase');
     }

    public function getShopCredit(){
        return $this->hasMany(Transaction::class,'to_account');
     }

     public function getShopDebit(){
        return $this->hasMany(Transaction::class,'from_account');
     }


   public function getShopExpense(){
      return $this->hasMany(Expense::class,'pay_account_id');
   }

   public function getDefaultAccountBalance(){

       $account =  Account::select('opening_balance','id')->where('status','default')->first();
      $id =  $account['id'];
       $ob = $account['opening_balance'];
       $send_from_bill = Purchase::where('account_id',$id)->sum('paid_amount');

       $receive_from_bill = Bill::where('bill_type','sell')->where('pay_account_id',$id)->sum('paid_amount');
       

       $send_from_payment = Payment::where('shop_account_id',$id)->where('payment_type','send')->sum('amount');
       $recieve_from_payment = Payment::where('shop_account_id',$id)->where('payment_type','receive')->sum('amount');
       $send_from_trs = Transaction::where('from_account',$id)->sum('amount');
       $recieve_from_trs = Transaction::where('to_account',$id)->sum('amount');
       $expense = Expense::where('pay_account_id',$id)->sum('amount');
       return ($ob+$receive_from_bill+$recieve_from_payment+$recieve_from_trs)-($send_from_bill+$send_from_payment+$send_from_trs+$expense);
   }


  public function getAccountBalance($id){
// return $id;
   $data =  Account::select('opening_balance','account_type')->where('id',$id)->first();

  if($data['account_type'] == "purchaser"){
    $ob = $data['opening_balance'];
   $purchase =  Purchase::where('supplier_id',$id)->get();
  $purchase_amount =  $purchase->sum('total_amount') - $purchase->sum('paid_amount');
    $send = Payment::where('account_id',$id)->where('payment_type','send')->sum('amount');
    return ($ob+$purchase_amount-$send);

  }elseif($data['account_type'] == "customer"){
    $ob = $data['opening_balance'];
    $rem = Bill::where('bill_type','sell')->where('account_id',$id)->sum('remaining');
    $recieve = Payment::where('account_id',$id)->where('payment_type','receive')->sum('amount');
    return ($ob+$rem - $recieve);

  }elseif($data['account_type'] == "shop-account"){
    $ob = $data['opening_balance'];
    $send_from_bill = Purchase::where('account_id',$id)->get();
    $purchase_amount =  $send_from_bill->sum('paid_amount'); 
    $receive_from_bill = Bill::where('bill_type','sell')->where('pay_account_id',$id)->sum('paid_amount');
    $send_from_payment = Payment::where('shop_account_id',$id)->where('payment_type','send')->sum('amount');
    $recieve_from_payment = Payment::where('shop_account_id',$id)->where('payment_type','receive')->sum('amount');
     $send_from_trs = Transaction::where('from_account',$id)->sum('amount');
     $recieve_from_trs = Transaction::where('to_account',$id)->sum('amount');
    $expense = Expense::where('pay_account_id',$id)->sum('amount');
    //  return $ob;
    return ($ob+$receive_from_bill+$recieve_from_payment+$recieve_from_trs)-($purchase_amount+$send_from_payment+$send_from_trs+$expense);
  }


}

public function getSupplierPayments(){
  return $this->hasMany(Payment::class,'account_id','id');
}
public function getCustomerPayments(){
  return $this->hasMany(Payment::class,'account_id');
}
}
