<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cookie;
use App\Cart;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //
    }

    public $cart_no;

    public function cart(){
        $value = Cookie::get('cart');
        //dd($value);
        $items=0;
        if($value!=null){
            //dd(count(Cart::where('cookie','=',$value)->take(1)));
            //  if(count(Cart::where('cookie','=',$value)->take(1))>0){
                $items=Cart::where('cookie','=',$value)->count();
                //dd($items);
            // }
        }
        //dd($items);
        $this->cart_no = $items;
        return;
    }

    public function getLogin(){
        $this->cart();
    	return view('auth.login')->with('cart_no',$this->cart_no);
    }

    public function getregister(){
        $this->cart();
    	return view('auth.register')->with('cart_no',$this->cart_no);
    }
}
