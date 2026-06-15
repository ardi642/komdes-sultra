<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gallery;

class GalleryIndex extends Component
{
    use WithPagination;

    #[\Livewire\Attributes\Url]
    public $search = '';

    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';
    
    public $perPage = 10;

    public function updatedFilterYear() { $this->resetPage(); }
    public function updatedFilterMonth() { $this->resetPage(); }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // The database will now handle ON DELETE SET NULL for gallery_images
        // and the CleanGalleryImages scheduler will clean up physical files later.
        
        $gallery->delete();

        session()->flash('message', 'Galeri berhasil dihapus.');
    }

    public function render()
    {
        $galleries = Gallery::query()
            ->when($this->search, function($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterYear, function($q) {
                $q->whereYear('date', $this->filterYear);
            })
            ->when($this->filterMonth, function($q) {
                $q->whereMonth('date', $this->filterMonth);
            })
            ->latest('date')
            ->paginate($this->perPage);

        return view('livewire.admin.gallery.gallery-index', [
            'galleries' => $galleries
        ])->layout('layouts.admin');
    }
}
