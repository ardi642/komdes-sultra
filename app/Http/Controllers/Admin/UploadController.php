<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

use App\Models\EditorImage;
use App\Models\GalleryImage;

class UploadController extends Controller
{
    public function uploadImage(Request $request, ImageService $imageService)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
        ]);

        try {
            $path = $imageService->upload($request->file('file'), 'editor');
            
            // Simpan jejak gambar ke database
            EditorImage::create([
                'file_path' => asset($path)
            ]);

            return response()->json(['location' => asset($path)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function uploadGalleryImage(Request $request, ImageService $imageService)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
        ]);

        try {
            $path = $imageService->upload($request->file('file'), 'galleries/photos');
            
            $image = GalleryImage::create([
                'image_path' => $path,
                // gallery_id is implicitly null
            ]);

            return response()->json([
                'id' => $image->id,
                'url' => asset($path)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
