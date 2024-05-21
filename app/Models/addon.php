<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class addon extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name','price','status'
    ];
    public function itemAddons(){
        return $this->hasMany(item_addon::class);
    }
}
