<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function homeorders(){
         $orders = Bill::where('kitchen_status','pending')->orderBy('id','desc')->get();
        $html = '';
        foreach ($orders as $key => $order) {
            $html .='
                <tr>
                    <td>  Order NO # <b> '.$order->id.'</b></td>
                    <td><a href="'.route('invoice',$order->id).'"><i class="ri-download-2-line"></i></a></td>
                </tr>
            ';
        }
        return $html;
    }

}
