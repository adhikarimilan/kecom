<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Auth;
use Session;
use File;
use App\Fileupload;
Use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','role','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::all();
        return view('banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $this->validate($request,[            
            'status'=>'required',           
            'photo'=>'required|image|mimes:jpeg,jpg,png|max:2200',
        ]);  
        $input=$request->except('_token');
        $uploadedFile = $request->file('photo'); 
        if($request->hasFile('photo')){ 
            if ($uploadedFile->isValid()) {
                $input['photo']=FileUpload::photo($request,'photo','','banner',1500,950);
                // $input['photo']=$uploadedFile->move('uploads/banners/', "banner".time().".".$uploadedFile->getClientOriginalExtension());

            }
        }
        $banner=Banner::create($input);        
        Session::flash('msg','New Banner has been created successfully.');
        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner=Banner::findOrFail($id);
        return view('banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[            
            'status'=>'required',           
            'photo'=>'image|mimes:jpeg,jpg,png|max:2200',
        ]);  
        $banner=Banner::findOrFail($id);
        $input=$request->except('_token');

        if($request->hasFile('photo')){ 
            $uploadedFile = $request->file('photo'); 
            if ($uploadedFile->isValid()) {
                if(File::exists($banner->photo)){ 
                    unlink($banner->photo);
                }  
                $input['photo']=FileUpload::photo($request,'photo','','banner',1500,950);

            }
        }
        $banner=$banner->update($input);        
        Session::flash('msg','Banner details has been updated successfully.');
        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::findOrFail($id);
        if(File::exists($banner->photo)){ 
            unlink($banner->photo);
        }  
        $banner->delete();
        Session::flash('msg','Banner details has been deleted successfully.');
        return redirect()->route('banners.index');
    }
}
