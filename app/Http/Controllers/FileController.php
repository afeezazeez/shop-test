<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getUpload(){
        return view('upload');
    }

    public function upload(Request $request){
        $files= $request->file('file');
//        foreach ($files as $file){
//            echo $file->getClientOriginalExtension() . "<br>";
//        }

    }
}
