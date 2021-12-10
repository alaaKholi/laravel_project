<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadFileTrait {

    
	// public function upload_image($file) {
    //     $name = time() + rand(1, 100000000);
    //     $ext = $file->getClientOriginalExtension();
    //     $path = "uploads/cars/$name.$ext";

    //     Storage::disk('local')->put($path, file_get_contents($file));

    //     if (file_exists(storage_path($path))) {

    //     }

    //     return $path;
    // }
    public function save_file (Request $request,$inital_path) {
        
        $status =false;

        if($request->hasfile('icon')){    

            $icon= $request->file('icon');

            $path = $inital_path;

            $icon_name = time()+rand(1, 10000000000) . '.' . $icon->getClientOriginalExtension();

            Storage::disk('local')->put($path.$icon_name , file_get_contents($icon));

            $status = Storage::disk('local')->exists($path.$icon_name);
        }
        //file_exists()
        return $status ? $path.$icon_name : null;
        // return [
        //     'status' => $status ,
        //     'path'=>$path.$icon_name
        //     ];
    }


}