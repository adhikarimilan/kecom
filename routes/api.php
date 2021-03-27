<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api','checkauthkey'])->group(function(){
Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user/checkout', 'Auth\API\v1\ApiController@placeorder')->name('api.user.placeorder');
});

Route::middleware(['checkauthkey'])->group(function(){

Route::post('/user/login', 'Auth\API\v1\LoginController@login')->name('api.user.login');
Route::post('/user/register', 'Auth\API\v1\RegisterController@register')->name('api.user.register');

Route::get('/getproducts', 'Auth\API\v1\ApiController@getproducts')->name('api.user.getproducts');

});
