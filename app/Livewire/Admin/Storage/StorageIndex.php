<?php

namespace App\Livewire\Admin\Storage;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GalleryImage;
use App\Models\EditorImage;
use Illuminate\Support\Facades\Storage;

class StorageIndex extends Component
{
    use WithPagination;

    public $activeTab = 'gallery'; // 'gallery' or 'editor'
    public $perPage = 25;
    
    // Checkbox selections
    public $selectAllGallery = false;
    public $selectedGalleryImages = [];
    
    public $selectAllEditor = false;
    public $selectedEditorImages = [];

    // State for the batch deletion orchestrator
    public $isDeleting = false;
    public $deleteTotal = 0;
    public $deleteProcessed = 0;
    public $deleteSuccess = 0;
    public $deleteFailed = 0;
    public $chunkIds = [];

    protected $listeners = ['startBatchDelete', 'processNextChunk', 'cancelBatchDelete'];

    public function updatedActiveTab()
    {
        $this->resetPage();
        $this->resetSelections();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function resetSelections()
    {
        $this->selectAllGallery = false;
        $this->selectedGalleryImages = [];
        $this->selectAllEditor = false;
        $this->selectedEditorImages = [];
    }

    public function updatedSelectAllGallery($value)
    {
        if ($value) {
            $this->selectedGalleryImages = $this->galleryTrash->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedGalleryImages = [];
        }
    }

    public function updatedSelectAllEditor($value)
    {
        if ($value) {
            $this->selectedEditorImages = $this->editorTrash->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedEditorImages = [];
        }
    }

    public function getGalleryTrashProperty()
    {
        return GalleryImage::whereNull('gallery_id')->latest()->paginate($this->perPage);
    }

    public function getEditorTrashProperty()
    {
        return EditorImage::whereNull('imageable_id')->latest()->paginate($this->perPage);
    }

    public function initEmptyAll()
    {
        if ($this->activeTab === 'gallery') {
            $ids = GalleryImage::whereNull('gallery_id')->pluck('id')->toArray();
        } else {
            $ids = EditorImage::whereNull('imageable_id')->pluck('id')->toArray();
        }
        
        $this->startBatchDeletionProcess($ids);
    }

    public function initDeleteSelected()
    {
        if ($this->activeTab === 'gallery') {
            $ids = $this->selectedGalleryImages;
        } else {
            $ids = $this->selectedEditorImages;
        }

        if (empty($ids)) return;

        $this->startBatchDeletionProcess($ids);
    }

    private function startBatchDeletionProcess($ids)
    {
        $this->isDeleting = true;
        $this->deleteTotal = count($ids);
        $this->deleteProcessed = 0;
        $this->deleteSuccess = 0;
        $this->deleteFailed = 0;
        
        // Chunk the IDs into sizes of 20
        $this->chunkIds = array_chunk($ids, 20);

        // Tell frontend to start the process loop
        $this->dispatch('batch-delete-started');
    }

    public function processNextChunk()
    {
        if (empty($this->chunkIds)) {
            // Finished
            $this->isDeleting = false;
            $this->dispatch('batch-delete-finished', [
                'success' => $this->deleteSuccess,
                'failed' => $this->deleteFailed
            ]);
            $this->resetSelections();
            return;
        }

        $currentChunk = array_shift($this->chunkIds);
        
        if ($this->activeTab === 'gallery') {
            $images = GalleryImage::whereIn('id', $currentChunk)->get();
            foreach ($images as $image) {
                try {
                    $relativePath = str_replace('/storage/', '', $image->image_path);
                    Storage::disk('public')->delete($relativePath);
                    $image->delete();
                    $this->deleteSuccess++;
                } catch (\Exception $e) {
                    $this->deleteFailed++;
                }
                $this->deleteProcessed++;
            }
        } else {
            $images = EditorImage::whereIn('id', $currentChunk)->get();
            foreach ($images as $image) {
                try {
                    $relativePath = str_replace('/storage/', '', $image->file_path);
                    Storage::disk('public')->delete($relativePath);
                    $image->delete();
                    $this->deleteSuccess++;
                } catch (\Exception $e) {
                    $this->deleteFailed++;
                }
                $this->deleteProcessed++;
            }
        }

        // Tell frontend to call again for the next chunk
        $this->dispatch('chunk-processed', [
            'processed' => $this->deleteProcessed,
            'total' => $this->deleteTotal
        ]);
    }

    public function cancelBatchDelete()
    {
        $this->chunkIds = []; // Empty the remaining chunks
        $this->isDeleting = false;
        
        $this->dispatch('batch-delete-cancelled', [
            'success' => $this->deleteSuccess,
            'failed' => $this->deleteFailed
        ]);
        
        $this->resetSelections();
    }

    public function render()
    {
        return view('livewire.admin.storage.storage-index', [
            'galleryTrash' => $this->galleryTrash,
            'editorTrash' => $this->editorTrash,
        ])->layout('layouts.admin');
    }
}
