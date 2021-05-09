<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Jobs\BulkImageUploadJob;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FileController extends Controller
{
    public function getUpload(){
        return view('upload');
    }

    public function upload(FileUploadRequest $request){
         if (count($request->file('file'))==1){
            $file= $request->file('file');
            $public_id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 9).rand(1,100);
            $image=Image::create([
                "public_id"=>$public_id,
                "tag"=>$request['tag'],
                "user_id"=>Auth::user()->id,
                "permission"=>$request['permission']
            ]);
            $image->attachMedia($request->file('file')[0]);
            session()->flash('success','Image uploaded to repository successfully');
            return redirect()->back();
        }

        $files =  $request->file('file');
        //BulkImageUploadJob::dispatch($files);
             foreach ($files as $file){
                 $public_id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 9).rand(1,100);
                 $image=Image::create([
                     "public_id"=>$public_id,
                     "tag"=>$request['tag'],
                     "user_id"=>Auth::user()->id,
                     "permission"=>$request['permission']
                 ]);
                 $image->attachMedia($file);
             }
            session()->flash('success','Images uploaded to repository successfully');
            return redirect()->back();
    }

    public function view($public_id){
        if($this->isPermitted($public_id)){
            $image=Image::where('public_id',$public_id)->first();
            return view('show',compact('image'));
        }
        else{
            return view('forbidden');
        }



    }

    public function isPermitted($public_id){
        $image=Image::where('public_id',$public_id)->first();
        if ($image->user_id===Auth::user()->id || $image->permission==='public'){
            return true;
        }
        return false;
    }


}
