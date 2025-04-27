<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, string $folder = 'uploads', string $disk = 'public', string $filename = null)
    {
        $filename = !is_null($filename) ? $filename : Str::random(10);
        $extension = $file->getClientOriginalExtension();
        
        return $file->storeAs(
            $folder,
            $filename . "." . $extension,
            $disk
        );
    }

    public function deleteFile(string $path, string $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}