<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class item_attribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'item_id',
        'attribute_id',
        'price',
        'description',
        'status'
    ] ;

    public function product()
{
    return $this->belongsTo(Product::class);
}
public function getAttrName(){
    return $this->belongsTo(attribute::class,'attribute_id');
}


public function productAttr()
{
    return $this->belongsTo(Product::class);
}

public function attribute()
{
    return $this->belongsTo(attribute::class);
}

}
