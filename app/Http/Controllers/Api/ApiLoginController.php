<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderBooker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_name'=>'required','password'=>'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }


        if (Auth::guard('bookers')->attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            $user = Auth::guard('bookers')->user();
            $token = $user->createToken('MyApp')->plainTextToken;


            return response()->json(['message' => 'User Login Successfully' , 'UserData' => $user , 'token' => $token], 200);
        }


        return response()->json(['message' => 'Unauthorized action'], 401);
    }



    public function update_token(Request $request){

        $validator = Validator::make($request->all(),
        [
            'fcm_token'=>'required'
        ]
    );

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 400);

    }

    try {



    $id  = Auth::guard('bookers')->user()->id;

    OrderBooker::where('id',$id)->update([
        'fcm'=>$request->fcm_token
    ]);
    return response()->json(['status' => 1,'message'=>'token update','fcm_token'=>$request->fcm_token], 201);


} catch (\Exception $ex) {
    return $ex->getMessage();
}

    }
}
