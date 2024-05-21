<?php

namespace App\Http\Controllers;

use App\Models\OrderBooker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderBookerController extends Controller
{
    public function index(){
        $booker = OrderBooker::all();

        return view('order-booker.index',compact('booker'));
    }

    public function create(){
        return view('order-booker.create');
    }
    public function show($id){

    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'nic'=>'required|numeric|digits:13|unique:order_bookers',
            'user_name'=>'required|string|unique:order_bookers',
            'password'=>'required|string|min:8|confirmed',
        ]);

        $booker = OrderBooker::create($request->all());
        $booker->password = Hash::make($request->password);
        if($booker->save()){
            return redirect()->route('order-booker.index')->with('success','order booker added successfully..!');
        }

    }

    public function edit($id){
        $booker = OrderBooker::where('id',$id)->get();
        return view('order-booker.edit',compact('booker'));
    }

    public function update(Request $request , $id){
        $validate = $request->validate([
            'name'=>'required|string',
            'nic'=>'required|numeric|digits:13|unique:order_bookers,nic,'.$id,
            'user_name'=>'required|string|unique:order_bookers,user_name,'.$id,
            'current_password' => 'sometimes|required|string|min:8',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);
        if($validate){
           $booker =  OrderBooker::where('id',$id)->update([
            'name'=>$request->name,
            'user_name'=>$request->user_name,
            'nic'=>$request->nic,]
           );

            if ($request->filled('password')) {
                // The user wants to change their password
                $booker =  OrderBooker::where('id',$id)->update([
                    'password'=>Hash::make($request->password),
                ]);

            }
            return redirect()->route('order-booker.index')->with('success','order booker update successfully..!');

        }
    }
}
