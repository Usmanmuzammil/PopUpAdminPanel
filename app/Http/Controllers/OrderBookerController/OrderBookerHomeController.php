<?php

namespace App\Http\Controllers\OrderBookerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagery;

class OrderBookerHomeController extends Controller
{
    public function index(){

        $category = Catagery::all();
        return view('order-booker-pannel.dashboard',compact('category'));

    }
}
