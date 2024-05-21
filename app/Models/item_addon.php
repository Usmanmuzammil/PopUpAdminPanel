<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item_addon extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'item_id','addon_id','status'
    ];


    public function Addon(){
        return $this->belongsTo(addon::class,'addon_id');

    }
    
}
