<?php

namespace App\Models;

// use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'account_id',
        'shop_account_id',
    ];

    // for recieve
    public function getPaymentDebitAccountName(){
        return $this->belongsTo(Account::class,'account_id');
    }
    public function getPaymentCreditAccountName(){
        return $this->belongsTo(Account::class,'shop_account_id');
    }
    

    public function getAccountName(){

        return $this->belongsTo(Account::class,'account_id');
    }


    public function getShopAccountName(){

        return $this->belongsTo(Account::class,'shop_account_id');
    }
    
}



