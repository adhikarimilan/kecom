<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Message;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    private $msgs;
    private $unseen;
    public function msgs(){
        $msgs=Message::orderBy('created_at','desc')->limit(4)->get();
        $this->msgs=$msgs;
        $unseen=count(Message::where('seen','=','0')->get());
        $this->unseen=$unseen;
    }

    public function index()
    {
        $coupons=Coupon::get();
        $this->msgs();
        return view('coupons.index',with(['coupons'=>$coupons,'msgs'=>$this->msgs,'unseen'=>$this->unseen]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //$data=[];
        return view('coupons.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[            
            'name'=>'required',           
            'coupon_code'=>'bail|required|unique:coupons',
        ]);
        $input=$request->except(['_token']);
        $input=Coupon::create($input);
        return redirect(route('coupons.index'))->with('success','coupon sucessfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon=Coupon::findOrFail($id);
        return view('coupons.edit',compact('coupon'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //dd($request->all());
        $coupon=Coupon::findOrFail($id);
        $input=$request->except(['_token']);
        $input['coupon_code']=$coupon->coupon_code;
        if($request['time_based']){

        }else{
            $input['time_based']=0;
            $input['start_time'] = null;
            $input['end_time'] = null;
        }
        $input=$coupon->update($input);
        return redirect(route('coupons.index'))->with('success','coupon sucessfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $coupon=Coupon::findOrFail($id);
        $input=$coupon->delete();
        return redirect(route('coupons.index'))->with('success','coupon sucessfully deleted');
    }
}
