<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;


public function getSupplier() {
    return $this->belongsTo(Account::class,'supplier_id');
}


public function getAccount() {
    return $this->belongsTo(Account::class,'shop_account_id');
}

}
