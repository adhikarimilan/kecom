<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','IndexPageController@index')->name('index');

Auth::routes(['verify' => true]);
Route::get('/register', 'Auth\LoginController@getregister')->name('register');
Route::get('/login', 'Auth\LoginController@getlogin')->name('login');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/product', 'ProductController@index');

Route::post('/addtocart', 'CartController@addtocart');
Route::get('/addtocart', function(){abort(404);});

Route::post('/delfromcart', 'CartController@delete');
Route::get('/delfromcart', function(){abort(404);});

Route::get('/product/{slug}', 'ProductController@view');
Route::get('/addproduct', 'HomeController@addproduct');
Route::get('/products', 'HomeController@viewproducts');
Route::post('/product/save', 'HomeController@saveproduct');
Route::get('/editproduct/{id}', 'HomeController@editproduct');
Route::post('updateproduct', 'HomeController@updateproduct');
Route::delete('/delproduct', 'HomeController@deleteproduct');
Route::post('togglefeatured', 'HomeController@togglefeatured');

Route::get('/checkout', 'CheckoutController@checkout');

Route::post('/placeorder','CheckoutController@placeorder');
Route::get('/dashboard','UserController@dashboard');
Route::post('/orderdet','UserController@orderdet');
Route::get('/orderdet', function(){abort(404);});

Route::get('/orders','HomeController@orders');
Route::post('/orderdetails','HomeController@orderdet');
Route::get('/orderdetails', function(){abort(404);});
Route::post('/verifyorder','HomeController@verifyorder');
Route::post('/cancelorder','HomeController@cancelorder')->name('order.cancel');
Route::post('/markasshipped','HomeController@markasshipped');
Route::get('/categories','HomeController@categories');
Route::post('/addcategory','HomeController@addcategory');
Route::get('/editcategory/{id}','HomeController@editcategory');
Route::post('updatecategory','HomeController@updatecategory');
Route::delete('/delcategory','HomeController@delcategory');
Route::post('cattogglefeatured', 'HomeController@cattogglefeatured');

Route::get('/contact','IndexPageController@contact');
Route::post('/contact','IndexPageController@savemsg');

Route::get('/messages','HomeController@messages');
Route::get('/message/{id}','HomeController@message');

Route::get('/allusers','HomeController@users');

Route::resource('coupons', 'CouponController');
Route::resource('banners','BannerController');

Route::post('/applycoupon','CartController@applycoupon')->name('coupon.apply');
Route::post('/removecoupon','CartController@removecoupon')->name('coupon.remove');