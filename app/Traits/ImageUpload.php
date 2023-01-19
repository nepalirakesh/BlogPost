<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageUpload
{
    
    public function uploadImage($file)
    {
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/images/', $filename);
        return $filename;
    }

    public function deleteImage($file)
    {
        $path = 'storage/images/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
