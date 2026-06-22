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

    #[\Livewire\Attributes\Url]
    public $filterAuthor = '';
    
    public $perPage = 10;

    // Batch Selection
    public $selectAll = false;
    public $selectedItems = [];
    
    // Orchestrator state for batch deletion
    public $isDeleting = false;
    public $deleteTotal = 0;
    public $deleteProcessed = 0;
    public $deleteSuccess = 0;
    public $deleteFailed = 0;
    public $chunkIds = [];

    protected $listeners = ['startBatchDelete', 'processNextChunk', 'cancelBatchDelete'];

    public function updatedFilterYear() { $this->resetPage(); $this->selectAll = false; $this->selectedItems = []; }
    public function updatedFilterMonth() { $this->resetPage(); $this->selectAll = false; $this->selectedItems = []; }
    public function updatedFilterAuthor() { $this->resetPage(); $this->selectAll = false; $this->selectedItems = []; }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selectAll = false;
        $this->selectedItems = [];
    }

    public function updatingPerPage()
    {
        $this->resetPage();
        $this->selectAll = false;
        $this->selectedItems = [];
    }

    public function updatedPage()
    {
        $this->selectAll = false;
        $this->selectedItems = [];
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $gallery->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus galeri ini.');
            return;
        }

        // The database will now handle ON DELETE SET NULL for gallery_images
        // and the CleanGalleryImages scheduler will clean up physical files later.
        
        $gallery->delete();

        session()->flash('message', 'Galeri berhasil dihapus.');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = Gallery::query()
                ->when($this->search, function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%');
                })
                ->when($this->filterYear, function($q) {
                    $q->whereYear('date', $this->filterYear);
                })
                ->when($this->filterMonth, function($q) {
                    $q->whereMonth('date', $this->filterMonth);
                })
                ->when($this->filterAuthor, function($q) {
                    $q->where('user_id', $this->filterAuthor);
                });
                
            $this->selectedItems = $query->latest('date')->paginate($this->perPage)->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function bulkDelete()
    {
        if (empty($this->selectedItems)) return;

        $this->isDeleting = true;
        $this->deleteTotal = count($this->selectedItems);
        $this->deleteProcessed = 0;
        $this->deleteSuccess = 0;
        $this->deleteFailed = 0;
        
        $this->chunkIds = array_chunk($this->selectedItems, 10);
        
        $this->dispatch('batch-delete-started');
    }

    public function processNextChunk()
    {
        if (empty($this->chunkIds)) {
            $this->isDeleting = false;
            $this->dispatch('batch-delete-finished', [
                'success' => $this->deleteSuccess,
                'failed' => $this->deleteFailed
            ]);
            $this->selectedItems = [];
            $this->selectAll = false;
            return;
        }

        $currentChunk = array_shift($this->chunkIds);
        
        $galleries = Gallery::whereIn('id', $currentChunk)->get();
        foreach ($galleries as $gallery) {
            try {
                if (auth()->user()->hasRole('Mitra Media') && $gallery->user_id !== auth()->id()) {
                    $this->deleteFailed++;
                    $this->deleteProcessed++;
                    continue;
                }

                $gallery->delete();
                $this->deleteSuccess++;
            } catch (\Exception $e) {
                $this->deleteFailed++;
            }
            $this->deleteProcessed++;
        }

        $this->dispatch('chunk-processed', [
            'processed' => $this->deleteProcessed,
            'total' => $this->deleteTotal
        ]);
    }

    public function cancelBatchDelete()
    {
        $this->chunkIds = [];
        $this->isDeleting = false;
        
        $this->dispatch('batch-delete-cancelled', [
            'success' => $this->deleteSuccess,
            'failed' => $this->deleteFailed
        ]);
        
        $this->selectedItems = [];
        $this->selectAll = false;
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
            ->when($this->filterAuthor, function($q) {
                $q->where('user_id', $this->filterAuthor);
            })
            ->with('user')
            ->latest('date')
            ->paginate($this->perPage);

        return view('livewire.admin.gallery.gallery-index', [
            'galleries' => $galleries,
            'authors' => \App\Models\User::orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}
