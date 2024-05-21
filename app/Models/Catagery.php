<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagery extends Model
{
    use HasFactory;

    protected $filable=[
        'catagery_name',
        'status',
        'user_id',
    ];



}
