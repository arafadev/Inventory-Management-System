<?php

namespace App\Http\Traits;



trait SaveImgTrait
{
    public function saveImg($file, $folder,  $old_img = null)
    {

        $img_name = hexdec(uniqid()) . '.' . $file->extension();
        $file->move($folder, $img_name);


        if ($folder != null && $old_img != null) {
            @unlink(public_path($folder . $old_img));
        }

        return $img_name;
    }

    
}