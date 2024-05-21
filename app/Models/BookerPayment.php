<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookerPayment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'amount','date','description','added_by','booker_id','status'
    ];

    public function getBooker(){
        return $this->belongsTo(OrderBooker::class,'booker_id');

    }


}
