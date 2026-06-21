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
    public $galleryImages = [];
    public $deletedImages = [];
    public $existing_photos = [];

    public function mount($id = null)
    {
        if ($id) {
            $gallery = Gallery::with(['images' => function($q) {
                $q->orderBy('order_column', 'asc');
            }])->findOrFail($id);
            if (auth()->user()->hasRole('Mitra Media') && $gallery->user_id !== auth()->id()) {
                session()->flash('error', 'Anda tidak memiliki hak untuk mengubah galeri ini.');
                return redirect()->route('admin.gallery.index');
            }

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

    public function removeThumbnail()
    {
        if ($this->existing_thumbnail) {
            app(ImageService::class)->delete($this->existing_thumbnail);
            if ($this->galleryId) {
                Gallery::where('id', $this->galleryId)->update(['thumbnail' => null]);
            }
            $this->existing_thumbnail = null;
        }
    }

    public function removeExistingPhoto($imageId)
    {
        // Now handled by AlpineJS via deletedImages array
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
            'galleryImages' => 'array',
            'deletedImages' => 'array',
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

        $galleryData = [
            'title' => $this->title,
            'slug' => $slug,
            'date' => $this->date,
            'description' => $this->description,
            'video_url' => $this->video_url,
            'thumbnail' => $thumbnailPath,
        ];

        if (!$this->galleryId) {
            $galleryData['user_id'] = auth()->id();
        }

        $gallery = Gallery::updateOrCreate(
            ['id' => $this->galleryId],
            $galleryData
        );

        // Update new and existing photos
        if (!empty($this->galleryImages)) {
            foreach ($this->galleryImages as $index => $imageId) {
                GalleryImage::where('id', $imageId)->update([
                    'gallery_id' => $gallery->id,
                    'order_column' => $index,
                ]);
            }
        }

        // Unlink explicitly deleted images
        if (!empty($this->deletedImages)) {
            GalleryImage::whereIn('id', $this->deletedImages)->update([
                'gallery_id' => null,
            ]);
        }

        $messageText = $this->galleryId ? 'Galeri berhasil diperbarui.' : 'Galeri berhasil ditambahkan.';
        session()->flash('message', $messageText);
        return redirect()->route('admin.gallery.index');
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-form')->layout('layouts.admin');
    }
}
