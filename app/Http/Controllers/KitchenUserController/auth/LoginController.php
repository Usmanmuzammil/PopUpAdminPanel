<?php

namespace App\Http\Controllers\KitchenUserController\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('kitchen');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('kitchen')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('kitchen.home'); // Redirect to the user dashboard
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('kitchen')->logout();
    return redirect()->route('kitchen.login');
    }
    public function user(){
        return "hi";
    }

}
