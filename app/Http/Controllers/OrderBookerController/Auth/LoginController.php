<?php

namespace App\Http\Controllers\OrderBookerController\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected $redirectTo = '/order-booker';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function guard()
    {
        return Auth::guard('bookers');
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => ['required'],
            'password' => ['required','min:8'],
        ]);

        if (Auth::guard('bookers')->attempt(['user_name'=>$request->user_name , 'password'=>$request->password])) {
            $request->session()->regenerate();

            return redirect()->route('order-booker.dashboard');
        }

        return back()->withErrors([
            'user_name' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        // return "view";
        Auth::guard('bookers')->logout();
        return redirect()->route('order-booker.login');
    }

}
