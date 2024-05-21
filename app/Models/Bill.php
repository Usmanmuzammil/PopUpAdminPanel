<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name',
        'phone',
        'date',
        'booker_id',
        'order_type',
        'user_id',
        'discount',
        'total',
        'paid_amount',
        'remaining',
        'bill_type',
        'desc',
        'coupon',
        'coupon_status'
    ];
    public function getWarehouse(){
        return $this->belongsTo(warehouse::class,'warehouse_id');
    }
    public function getBooker(){
        return $this->belongsTo(OrderBooker::class,'booker_id');
    }
    public function getBiller(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getBillDetail(){
        return $this->hasMany(Bill_detail::class,'bill_id');
    }
    public function getVariants(){
        
    }





    public function getCustomer(){
        return $this->belongsTo(Account::class,'account_id');
    }
    public function getPurchaser(){
        return $this->belongsTo(Account::class,'account_id');
    }

    public function getShopAccount(){
        return $this->belongsTo(Account::class,'pay_account_id');
    }




    public function getProfit($id,$date){
        return  DB::table('bills as b')->join('bill_details as bd', 'b.id', '=', 'bd.bill_id')->join('products as p', 'bd.product_id', '=', 'p.id')->where('b.bill_type', '=', 'sell')->whereNull('b.deleted_at')->where('b.date',$date)->where('b.id',$id)->selectRaw('sum((bd.price - p.purchase_price) * bd.meter) as aggregate')->value('aggregate');
    }

    public function getMonthlyProfit($date){
       //return $date;
        return  DB::table('bills as b')->join('bill_details as bd', 'b.id', '=', 'bd.bill_id')->join('products as p', 'bd.product_id', '=', 'p.id')->where('b.bill_type', '=', 'sell')->where('b.date',$date)->whereNull('b.deleted_at')
->selectRaw('sum((bd.price - p.purchase_price) * bd.qty) as aggregate')->value('aggregate');
    }

    public function getSaleQty($id){

      return  Bill::join('bill_details', 'bills.id', '=', 'bill_details.bill_id')->
        select(DB::raw('SUM(bill_details.qty) AS total_qty'))
       ->where('bills.id',$id)
        ->first();
    }


	public function getSaleQtyMonthly($date,$type){

		return  Bill::join('bill_details', 'bills.id', '=', 'bill_details.bill_id')->
        select(DB::raw('SUM(bill_details.qty) AS total_qty'))
       ->where('bills.bill_type',$type)
	   ->where('bills.date',$date)
        ->first();

	}
}
