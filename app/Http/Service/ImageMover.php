<?php

namespace App\Http\Service;

use Illuminate\Http\UploadedFile;

final class ImageMover
{
    public static function moveImage(UploadedFile|null $file): ?string
    {
        if (null === $file) {
            return null;
        }

        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        return $filename;
    }
}
