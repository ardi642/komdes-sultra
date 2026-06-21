<?php

namespace App\Livewire\Admin\Issue;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Issue;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class IssueIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $issue_id;
    public $title, $slug, $description, $icon_svg, $status = 'active';
    public $cover_image, $new_cover_image;
    
    public $isModalOpen = false;

    // Batch Delete Properties
    public $selectedItems = [];
    public $selectAll = false;
    public $isDeleting = false;
    public $deleteTotal = 0;
    public $deleteProcessed = 0;
    public $deleteSuccess = 0;
    public $deleteFailed = 0;

    #[\Livewire\Attributes\Url]
    public $search = '';

    #[\Livewire\Attributes\Url]
    public $filterStatus = '';
    
    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';
    
    public $perPage = 10;

    public function updatedFilterStatus() { $this->resetPage(); }
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

    public function render()
    {
        $query = Issue::latest();
        
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->filterYear) {
            $query->whereYear('created_at', $this->filterYear);
        }

        if ($this->filterMonth) {
            $query->whereMonth('created_at', $this->filterMonth);
        }

        return view('livewire.admin.issue.issue-index', [
            'issues' => $query->paginate($this->perPage),
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->issue_id = '';
        $this->title = '';
        $this->slug = '';
        $this->description = '';
        $this->icon_svg = '';
        $this->status = 'active';
        $this->cover_image = null;
        $this->new_cover_image = null;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store(ImageService $imageService)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:issues,slug,' . $this->issue_id,
            'description' => 'nullable|string',
            'icon_svg' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'new_cover_image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $issueData = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'icon_svg' => $this->icon_svg,
            'status' => $this->status,
        ];

        if (!$this->issue_id) {
            $issueData['user_id'] = auth()->id();
        }

        // Handle Image Upload
        if ($this->new_cover_image) {
            // Delete old image if updating
            if ($this->issue_id && $this->cover_image) {
                $imageService->delete($this->cover_image);
            }
            // Upload new image
            $issueData['cover_image'] = $imageService->upload($this->new_cover_image, 'issues');
        }

        Issue::updateOrCreate(['id' => $this->issue_id], $issueData);

        session()->flash('message', $this->issue_id ? 'Isu Kampanye berhasil diperbarui.' : 'Isu Kampanye berhasil ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $issue->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengubah isu kampanye ini.');
            return;
        }

        $this->issue_id = $id;
        $this->title = $issue->title;
        $this->slug = $issue->slug;
        $this->description = $issue->description;
        $this->icon_svg = $issue->icon_svg;
        $this->status = $issue->status;
        $this->cover_image = $issue->cover_image;
        
        $this->openModal();
    }

    public function delete($id, ImageService $imageService)
    {
        $issue = Issue::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $issue->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus isu kampanye ini.');
            return;
        }
        
        if ($issue->posts()->exists() || $issue->events()->exists()) {
            session()->flash('error', 'Gagal menghapus: Isu Kampanye ini masih digunakan pada publikasi atau acara.');
            return;
        }

        // Delete the image file from storage
        if ($issue->cover_image) {
            $imageService->delete($issue->cover_image);
        }

        $issue->delete();
        session()->flash('message', 'Isu Kampanye berhasil dihapus.');
    }

    // Batch Delete Methods
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = Issue::pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function startBatchDelete()
    {
        if (empty($this->selectedItems)) return;
        
        $this->isDeleting = true;
        $this->deleteTotal = count($this->selectedItems);
        $this->deleteProcessed = 0;
        $this->deleteSuccess = 0;
        $this->deleteFailed = 0;
        
        $this->dispatch('batch-delete-started');
    }

    public function processNextChunk(ImageService $imageService)
    {
        if (!$this->isDeleting) return;

        $chunkSize = 10;
        $itemsToProcess = array_slice($this->selectedItems, $this->deleteProcessed, $chunkSize);

        if (empty($itemsToProcess)) {
            $this->isDeleting = false;
            $this->selectedItems = [];
            $this->selectAll = false;
            
            $this->dispatch('batch-delete-finished');
            return;
        }

        foreach ($itemsToProcess as $id) {
            $issue = Issue::find($id);
            if ($issue) {
                if (auth()->user()->hasRole('Mitra Media') && $issue->user_id !== auth()->id()) {
                    $this->deleteFailed++;
                    continue;
                }

                if ($issue->posts()->exists() || $issue->events()->exists()) {
                    $this->deleteFailed++;
                } else {
                    if ($issue->cover_image) {
                        $imageService->delete($issue->cover_image);
                    }
                    $issue->delete();
                    $this->deleteSuccess++;
                }
            }
        }

        $this->deleteProcessed += count($itemsToProcess);
        
        $this->dispatch('chunk-processed');
    }

    public function cancelBatchDelete()
    {
        $this->isDeleting = false;
        $this->selectedItems = [];
        $this->selectAll = false;
    }
}
