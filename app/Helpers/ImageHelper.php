<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function compressAndStoreImage($file, $folder = 'student-photos')
{
    $name = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();

    $path = $file->store('public');

    // Kompress gambar menggunakan Intervention/Image
    $compressedImage = Image::make(storage_path('app/' . $path))
        ->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode('jpg', 80);

    // Simpan gambar terkompresi ke storage
    $filename = $file->hashName();
    $compressedPath = 'public/' . $folder . '/' . $filename;
    Storage::put($compressedPath, $compressedImage);

    // Hapus gambar asli
    File::delete(storage_path('app/' . $path));
    return $filename;
}
