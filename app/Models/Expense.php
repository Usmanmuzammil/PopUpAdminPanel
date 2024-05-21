<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;


    public function getPayAcc(){
        return $this->belongsTo(Account::class,'pay_account_id');
    }
    
}
