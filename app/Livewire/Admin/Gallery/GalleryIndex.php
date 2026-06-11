<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gallery;

class GalleryIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Let Model boot/event or ImageService handle actual file deletion later if needed.
        // For now cascadeOnDelete drops the DB rows.
        // Ideally we delete images from disk too. We can do that via ImageService.
        
        $images = $gallery->images;
        $imageService = app(\App\Services\ImageService::class);
        
        if ($gallery->thumbnail) {
            $imageService->delete($gallery->thumbnail);
        }

        foreach ($images as $img) {
            $imageService->delete($img->image_path);
        }

        $gallery->delete();

        session()->flash('message', 'Galeri berhasil dihapus.');
    }

    public function render()
    {
        $galleries = Gallery::query()
            ->when($this->search, function($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest('date')
            ->paginate(10);

        return view('livewire.admin.gallery.gallery-index', [
            'galleries' => $galleries
        ])->layout('layouts.admin');
    }
}
