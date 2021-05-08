<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getUpload(){
        return view('upload');
    }

    public function upload(FileUploadRequest $request){

        return $request;
        $file= $request->file('file');

    }
}
