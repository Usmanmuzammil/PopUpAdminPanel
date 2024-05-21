<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'date',
        'account_id',
        'amount',
        'payment_type',
        'account_type',
        'desc'
    ];

    public function getAccount($column) {
        if ($column == 'from_account') {
            return $this->belongsTo(Account::class, 'from_account')->first()->name;
        } else {
            return $this->belongsTo(Account::class, 'to_account')->first()->name;
        }
    }

}
