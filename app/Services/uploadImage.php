<?php
namespace App\Services;
use Input, Request;

class uploadImage{
    public function upload($path, $name)
    {
        $file = Input::file($name);
        $allowed_extensions = ['jpg', 'png', 'gif'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return redirect()->back()->with('result', 'image must be the jpg, png, or gif format');
        }
        $file_extension = $file->getClientOriginalExtension();
        $fileName = str_random(15).'.'.$file_extension;
        $destination = $path.$fileName;
        $file->move($path,$fileName);
        return $destination;
    }
}