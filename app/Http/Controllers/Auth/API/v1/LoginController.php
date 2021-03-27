<?php

namespace App\Http\Controllers\Auth\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use App\User;



class LoginController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['apiauth']);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $credentials = request(['email', 'password']);
            //$credentials['active'] = 1;
            $res=Auth::attempt($credentials);
           
        if($res){
        $user=Auth::user();// $user=$request->user();
        $random = Str::random(200);
        $d=date('_Y-m-d_h:i:s_').rand(11111,99999);
        $api_key=$random.$d;
        $user->api_token=$api_key;
        $user->save();
        return response()->json(['user'=>$user]);
        }
        return response()->json(['error'=>'invalid']);

    }
}