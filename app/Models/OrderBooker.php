<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bill;
class OrderBooker extends Authenticatable
{
    use  HasFactory, Notifiable , HasApiTokens;

    protected $gard = 'bookers';
    protected $fillable= [
        'name','nic','user_name','password'
    ];

    public function getOrders(){
        return $this->hasMany(Bill::class,'booker_id');
    }
    public function getPayment(){
        return $this->hasMany(BookerPayment::class,'booker_id');
    }
    public function getBalance($id, $pos_settings = null )
{
$total_amount = 0;
$total_payment = 0;

    if ($pos_settings) {
       $data = pos_seting::wheredate('closing_date','>=',$pos_settings)->wheredate('date','<=',$pos_settings)->get();

      $total_amount =  Bill::where('booker_id', $id)->where('created_at','>=', $data[0]->created_at)
        ->where('created_at','<=', $data[0]->closing_date)->sum('net_total');
        // $total_amount = Bill::where('booker_id', $id)
        //     ->where('created_at', '<', $pos_settings[0])
        //     ->where('created_at', '>', $pos_settings[1])
        //     ->sum('net_total');

        $total_payment = BookerPayment::where('booker_id', $id)
            ->whereNull('deleted_at')
            ->where('created_at', '>=', $data[0]->created_at)
            ->where('created_at', '<=', $data[0]->closing_date)
            ->sum('amount');
    } else {
        $total_amount = Bill::where('booker_id', $id)->sum('net_total');
        $total_payment = BookerPayment::where('booker_id', $id)->sum('amount');
    }

    return $total_amount - $total_payment;
}

    public function bills(){
        return $this->hasMany(Bill::class,'booker_id');
    }

    public function getDailySell($id , $date=null , $count = null){
      
        $posSetting = pos_seting::where('date',$date)->first();

        if($count){
            return $total_amount =  Bill::where('booker_id', $id)->where('created_at','>=', $posSetting->created_at)
        ->where('created_at','<=', $posSetting->closing_date)->count();

        }
        if($date == null){

            return $total_amount =  Bill::where('booker_id', $id)->sum('net_total');

        }
        
       return $total_amount =  Bill::where('booker_id', $id)->where('created_at','>=', $posSetting->created_at)
        ->where('created_at','<=', $posSetting->closing_date)->sum('net_total');
        

    }
}