<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Jobs\BulkImageUploadJob;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FileController extends Controller
{
    public function getUpload(){
        return view('upload');
    }

    public function upload(Request $request){
        $rules = array(
            'tag'=>'required',
            'permission'=>'required',
            'file' => 'required',
            'file.*' => 'mimes:jpeg,jpg,png'
        );
        $messages = [
            'mimes' => 'Images can either be of type jpeg,jpg or png'
        ];

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
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
            return response()->json(['success'=>'Image uploaded successfully']);
        }

        $files =  $request->file('file');

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
        return response()->json(['success'=>'Images Uploaded Successfully']);

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
