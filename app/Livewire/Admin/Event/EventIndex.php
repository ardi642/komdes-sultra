<?php

namespace App\Livewire\Admin\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Issue;
use App\Services\ImageService;
use Illuminate\Support\Str;

class EventIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $isFormOpen = false;
    public $event_id;
    
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

    // Bulk Edit Form
    public $isBulkEditModalOpen = false;
    public $bulkEditAction = 'append'; // 'append' or 'replace'
    public $bulkSelectedTags = [];
    public $bulkSelectedIssues = '';
    

    // Form fields
    public $title, $slug, $content, $event_date, $location;
    public $is_published = true;
    public $cover_image, $new_cover_image;
    
    // Many-to-Many relations
    public $selectedTags = [];
    public $selectedIssues = '';
    
    #[\Livewire\Attributes\Url]
    public $search = '';
    
    #[\Livewire\Attributes\Url]
    public $filterStatus = '';

    #[\Livewire\Attributes\Url]
    public $filterTag = [];
    
    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';

    public $perPage = 10;

    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterTag() { $this->resetPage(); }
    public function updatedFilterYear() { $this->resetPage(); }
    public function updatedFilterMonth() { $this->resetPage(); }

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

    public function render()
    {
        $query = Event::with(['tags', 'issues'])->latest();
        
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus === 'published') {
            $query->where('is_published', true);
        } elseif ($this->filterStatus === 'draft') {
            $query->where('is_published', false);
        }

        if (!empty($this->filterTag)) {
            $query->whereHas('tags', function($q) {
                $q->whereIn('tags.id', $this->filterTag);
            });
        }

        if ($this->filterYear) {
            $query->whereYear('created_at', $this->filterYear);
        }

        if ($this->filterMonth) {
            $query->whereMonth('created_at', $this->filterMonth);
        }

        $events = $query->paginate($this->perPage);

        return view('livewire.admin.event.event-index', [
            'events' => $events,
            'allTags' => Tag::orderBy('name')->get(),
            'allIssues' => Issue::where('status', 'active')->orderBy('title')->get(),
        ])->layout('layouts.admin');
    }
    
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = Event::latest();
            if ($this->search) $query->where('title', 'like', '%' . $this->search . '%');
            if ($this->filterStatus === 'published') $query->where('is_published', true);
            elseif ($this->filterStatus === 'draft') $query->where('is_published', false);
            if (!empty($this->filterTag)) $query->whereHas('tags', fn($q) => $q->whereIn('tags.id', $this->filterTag));
            if ($this->filterYear) $query->whereYear('created_at', $this->filterYear);
            if ($this->filterMonth) $query->whereMonth('created_at', $this->filterMonth);
            
            $this->selectedItems = $query->paginate($this->perPage)->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedItems = [];
        }
    }
    

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isFormOpen = true;
    }

    public function closeForm()
    {
        $this->isFormOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->event_id = '';
        $this->title = '';
        $this->slug = '';
        $this->content = '';
        $this->event_date = '';
        $this->location = '';
        $this->is_published = '1';
        $this->cover_image = null;
        $this->new_cover_image = null;
        $this->selectedTags = [];
        $this->selectedIssues = '';
    }

    public function store(ImageService $imageService)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:events,slug,' . $this->event_id,
            'content' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'is_published' => 'boolean',
            'new_cover_image' => 'nullable|image|max:3072', // max 3MB
        ]);

        $eventData = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'event_date' => $this->event_date,
            'location' => $this->location,
            'is_published' => $this->is_published === '1',
        ];

        if (!$this->event_id) {
            $eventData['user_id'] = auth()->id();
        }

        // Set published_at if publishing for the first time
        if ($this->is_published === '1' && !$this->event_id) {
            $eventData['published_at'] = now();
        }

        // Handle Image Upload
        if ($this->new_cover_image) {
            if ($this->event_id && $this->cover_image) {
                $imageService->delete($this->cover_image);
            }
            $eventData['cover_image'] = $imageService->upload($this->new_cover_image, 'events');
        }

        $event = Event::updateOrCreate(['id' => $this->event_id], $eventData);

        // Sync Tags and Issues
        $event->tags()->sync($this->selectedTags);
        $event->issues()->sync($this->selectedIssues ? [$this->selectedIssues] : []);

        session()->flash('message', $this->event_id ? 'Agenda Acara berhasil diperbarui.' : 'Agenda Acara berhasil ditambahkan.');

        $this->closeForm();
    }

    public function edit($id)
    {
        $event = Event::with(['tags', 'issues'])->findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $event->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengubah agenda ini.');
            return;
        }
        
        $this->event_id = $event->id;
        $this->title = $event->title;
        $this->slug = $event->slug;
        $this->content = $event->content;
        $this->event_date = $event->event_date->format('Y-m-d\TH:i');
        $this->location = $event->location;
        $this->is_published = $event->is_published ? '1' : '0';
        $this->cover_image = $event->cover_image;
        
        $this->selectedTags = $event->tags->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->selectedIssues = $event->issues->first()?->id ?? '';
        
        $this->isFormOpen = true;
    }

    public function delete($id, ImageService $imageService)
    {
        $event = Event::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $event->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus agenda ini.');
            return;
        }
        
        if ($event->cover_image) {
            $imageService->delete($event->cover_image);
        }

        $event->delete();
        session()->flash('message', 'Agenda Acara berhasil dihapus.');
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

    public function processNextChunk(ImageService $imageService)
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
        
        $events = Event::whereIn('id', $currentChunk)->get();
        foreach ($events as $event) {
            try {
                if (auth()->user()->hasRole('Mitra Media') && $event->user_id !== auth()->id()) {
                    $this->deleteFailed++;
                    $this->deleteProcessed++;
                    continue;
                }

                if ($event->cover_image) {
                    $imageService->delete($event->cover_image);
                }
                $event->delete();
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

    public function openBulkEditModal()
    {
        if (empty($this->selectedItems)) return;
        
        $this->bulkEditAction = 'append';
        $this->bulkSelectedTags = [];
        $this->bulkSelectedIssues = '';
        $this->isBulkEditModalOpen = true;
    }

    public function closeBulkEditModal()
    {
        $this->isBulkEditModalOpen = false;
    }

    public function executeBulkEdit()
    {
        if (empty($this->selectedItems)) return;

        \Illuminate\Support\Facades\DB::transaction(function () {
            $events = Event::whereIn('id', $this->selectedItems)->get();

            foreach ($events as $event) {
                if (auth()->user()->hasRole('Mitra Media') && $event->user_id !== auth()->id()) {
                    continue;
                }

                // Tags Update
                if (!empty($this->bulkSelectedTags)) {
                    if ($this->bulkEditAction === 'replace') {
                        $event->tags()->sync($this->bulkSelectedTags);
                    } else {
                        $event->tags()->syncWithoutDetaching($this->bulkSelectedTags);
                    }
                } elseif ($this->bulkEditAction === 'replace') {
                    $event->tags()->detach();
                }

                // Issues Update
                if (!empty($this->bulkSelectedIssues)) {
                    $event->issues()->sync([$this->bulkSelectedIssues]);
                }
            }
        });

        $this->selectedItems = [];
        $this->selectAll = false;
        $this->closeBulkEditModal();
        session()->flash('message', 'Label pada acara terpilih berhasil diperbarui.');
    }


    public function removeCoverImage(ImageService $imageService)
    {
        if ($this->event_id) {
            $event = Event::findOrFail($this->event_id);
            if ($event->cover_image) {
                $imageService->delete($event->cover_image);
                $event->update(['cover_image' => null]);
            }
        }
        $this->cover_image = null;
        $this->new_cover_image = null;
    }

    public function savePreview()
    {
        $coverImageUrl = null;
        if ($this->new_cover_image) {
            try {
                $coverImageUrl = $this->new_cover_image->temporaryUrl();
            } catch (\Exception $e) {}
        } elseif ($this->cover_image) {
            $coverImageUrl = $this->cover_image;
        }

        session(['preview_post_data' => [
            'title' => $this->title,
            'type' => 'acara',
            'content' => $this->description,
            'event_date' => $this->event_date,
            'time' => $this->time,
            'location' => $this->location,
            'cover_image' => $coverImageUrl,
        ]]);

        $this->dispatch('open-preview-tab');
    }
}
