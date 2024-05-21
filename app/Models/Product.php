<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'product_name',
        'unit_id',
        'purchase_price',
        'selling_price',
        'status',
        'user_id',
    ];

 public function getUnit(){
    return $this->belongsTo(unit::class,'unit_id');
 }


    public function getStock($id){

        $data = Product::select('opening_stock')->where('id',$id)->first();
        $purchased_items = DB::table('bill_details')
            ->join('bills', 'bill_details.bill_id', '=', 'bills.id')
            ->where('bill_details.product_id', $id)
            ->where('bills.bill_type', 'purchase')
            ->sum('bill_details.qty');

        $sell_items = DB::table('bill_details')
            ->join('bills', 'bill_details.bill_id', '=', 'bills.id')
            ->where('bill_details.product_id', $id)
            ->where('bills.bill_type', 'sell')
            ->sum('bill_details.qty');

        return $data->opening_stock + $purchased_items - $sell_items;


    }


    public function getCategory(){
        return $this->belongsTo(Catagery::class,'category_id');
    }

    public function itemAttributes()
    {
        return $this->hasMany(item_attribute::class,'item_id');
    }
    public function itemAddon()
    {
        return $this->hasMany(item_addon::class,'item_id');
    }
    
    public function getAddon()
    {
        return $this->hasMany(item_addon::class,'item_id');
    }
    
    public function itemExtra(){
        return $this->hasMany(item_extras::class,'item_id');
    }
    
    
}


