<?php
namespace App\Traits;
trait ImageUpload
{
    public function uploadImage($file)
    {
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/images/', $filename);
        return $filename;

    }
}





?>
