<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Str;
use App\Services\ImageService;

class GalleryForm extends Component
{
    use WithFileUploads;

    public $galleryId;
    public $title;
    public $date;
    public $description;
    public $video_url;
    
    // For single thumbnail upload
    public $thumbnail;
    public $existing_thumbnail;
    
    // For multiple photos upload
    public $photos = [];
    public $existing_photos = [];

    public function mount($id = null)
    {
        if ($id) {
            $gallery = Gallery::with('images')->findOrFail($id);
            $this->galleryId = $gallery->id;
            $this->title = $gallery->title;
            $this->date = $gallery->date->format('Y-m-d');
            $this->description = $gallery->description;
            $this->video_url = $gallery->video_url;
            $this->existing_thumbnail = $gallery->thumbnail;
            $this->existing_photos = $gallery->images->toArray();
        } else {
            $this->date = now()->format('Y-m-d');
        }
    }

    public function updatedTitle()
    {
        // Auto-generate slug could be done here if needed
    }

    public function removeExistingPhoto($imageId)
    {
        $image = GalleryImage::findOrFail($imageId);
        app(ImageService::class)->delete($image->image_path);
        $image->delete();

        // Remove from array
        $this->existing_photos = collect($this->existing_photos)->reject(function ($photo) use ($imageId) {
            return $photo['id'] === $imageId;
        })->toArray();
    }

    public function removeNewPhoto($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function save()
    {
        // Extract src if user pastes iframe code
        if ($this->video_url && preg_match('/src="([^"]+)"/', $this->video_url, $match)) {
            $this->video_url = $match[1];
        }

        $this->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'photos.*' => 'image|max:2048', // 2MB max per image
        ]);

        $slug = Str::slug($this->title);
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Gallery::where('slug', $slug)->where('id', '!=', $this->galleryId)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imageService = app(ImageService::class);

        $thumbnailPath = $this->existing_thumbnail;
        if ($this->thumbnail) {
            if ($this->existing_thumbnail) {
                $imageService->delete($this->existing_thumbnail);
            }
            $thumbnailPath = $imageService->upload($this->thumbnail, 'galleries/thumbnails');
        }

        $gallery = Gallery::updateOrCreate(
            ['id' => $this->galleryId],
            [
                'title' => $this->title,
                'slug' => $slug,
                'date' => $this->date,
                'description' => $this->description,
                'video_url' => $this->video_url,
                'thumbnail' => $thumbnailPath,
            ]
        );

        // Upload new photos
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $path = $imageService->upload($photo, 'galleries/photos');
                $gallery->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        // If no thumbnail was provided, but we have images, automatically set the first image as thumbnail
        if (!$gallery->thumbnail && $gallery->images()->count() > 0) {
            $firstImage = $gallery->images()->first();
            $gallery->update([
                'thumbnail' => $firstImage->image_path
            ]);
        }

        session()->flash('message', 'Galeri berhasil disimpan.');
        return redirect()->route('admin.gallery.index');
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-form')->layout('layouts.admin');
    }
}
