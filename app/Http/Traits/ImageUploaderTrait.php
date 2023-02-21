<?php

namespace App\Http\Traits;

trait ImageUploaderTrait
{
    public function uploadImage($file)
    {
        if($file){
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('storage/Image'), $filename);
            return $filename;
        }
    }
}
