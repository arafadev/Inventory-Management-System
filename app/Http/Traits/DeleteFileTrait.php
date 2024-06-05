<?php

namespace App\Http\Traits;



trait DeleteFileTrait
{
    public function deleteFile($path, $file)
    {
        @unlink(public_path($path . $file));
    }
}