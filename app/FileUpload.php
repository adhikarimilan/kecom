<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Image;
use URL;
class FileUpload extends Model
{
    public static function photo($request,$filename,$default='',$path,$h,$w){
    	
    	$photo=$request->$filename;
        if($default)
        $name=rand(1111,9999)."-".date('Y-m-d')."-".time().$default.".".$photo->getClientOriginalExtension();
        else 
    	$name=rand(1111,9999)."-".date('Y-md-d')."-".time().".".$photo->getClientOriginalExtension();

    	$img = Image::make($photo->getRealPath()); 

        $canvas = Image::canvas($h, $w);

        $img->fit($h, $w, function ($constraint) {
            $constraint->upsize();
        });

        $canvas->insert($img, 'center');

    	$canvas->resize($h,$w, function ($constraint) {
    	$constraint->aspectRatio();
    	})->save($path.'/'.$name);

    	return $path.'/'.$name;
}
public static function wphoto($request,$filename,$default='',$path,$w){
    	
    $photo=$request->$filename; 

    $image=Image::make($photo->getRealPath())->widen($w, function ($constraint) {
        $constraint->upsize();
    });
    $name=rand(1111,9999)."_".date('Y-m-d')."_".time().".".$photo->getClientOriginalExtension();
    //dd($path);
    $image->save($path.'/'.$name);
    
    return $path.'/'.$name;

    }

    public static function pphoto($request,$filename,$default='',$path,$h,$w){
    	
    	$photo=$request->$filename;
        if($default)
        $name=$default . ".".$photo->getClientOriginalExtension();
        else 
    	$name=rand(1111,9999)."-".date('Ymd_his')."-".time().".".$photo->getClientOriginalExtension();

    	$image=Image::make($photo->getRealPath())->widen($w, function ($constraint) {
            $constraint->upsize();
        });
        //dd($path);
        $image->save($path.'/'.$name);

    	return $name;
}

}
