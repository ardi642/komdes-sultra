<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Upload an image and return the path.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function upload(UploadedFile $file, string $directory = 'uploads'): string
    {
        // Generate a random filename with original extension
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        
        // Store in the public disk
        $path = $file->storeAs($directory, $filename, 'public');

        return '/storage/' . $path;
    }

    /**
     * Delete an image from storage.
     *
     * @param string|null $path
     * @return bool
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        // Remove '/storage/' prefix to get the actual path in the public disk
        $relativePath = str_replace('/storage/', '', $path);
        
        if (Storage::disk('public')->exists($relativePath)) {
            return Storage::disk('public')->delete($relativePath);
        }

        return false;
    }
}
