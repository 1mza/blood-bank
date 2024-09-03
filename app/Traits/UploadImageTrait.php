<?php

namespace app\Traits;
trait UploadImageTrait
{
    public function uploadImage($image, $path)
    {
//        $image = $request->file('image');
        $name = $image->getClientOriginalName();
//        $path = $image->store('posts','mostafa');
        $path = $image->storeAs($path, $name, 'mostafa');
        return $path;
    }
}
