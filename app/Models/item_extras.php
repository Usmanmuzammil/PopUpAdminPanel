<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item_extras extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillables=[
        'item_id','name','price','status'
    ];
    public function getProduct(){
        return $this->belongsTo(Product::class,'item_id');
    }

}
