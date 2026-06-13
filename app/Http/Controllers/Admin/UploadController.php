<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request, ImageService $imageService)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB Max
        ]);

        try {
            $path = $imageService->upload($request->file('file'), 'editor');
            return response()->json(['location' => asset($path)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
