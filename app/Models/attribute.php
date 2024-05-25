<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class attribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'attribute_name',
        'status',
        'price'
    ] ;
    public function getItemAttr(){
        return $this->hasMany(item_attribute::class,'attribute_id');
    }
    
    public function itemAttributes()
    {
        return $this->hasMany(item_attribute::class);
    }

    public function getStatusAttribute()
    {
        return $this->attributes['status']; // Replace 'status' with the actual column name in your database
    }
    
}
