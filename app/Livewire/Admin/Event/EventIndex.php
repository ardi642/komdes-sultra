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
    
    // Form fields
    public $title, $slug, $content, $event_date, $location;
    public $is_published = true;
    public $cover_image, $new_cover_image;
    
    // Many-to-Many relations
    public $selectedTags = [];
    public $selectedIssues = [];
    
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
    }

    public function updatingPerPage()
    {
        $this->resetPage();
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

        return view('livewire.admin.event.event-index', [
            'events' => $query->paginate($this->perPage),
            'allTags' => Tag::orderBy('name')->get(),
            'allIssues' => Issue::where('status', 'active')->orderBy('title')->get(),
        ])->layout('layouts.admin');
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
        $this->selectedIssues = [];
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
        $event->issues()->sync($this->selectedIssues);

        session()->flash('message', $this->event_id ? 'Agenda Acara berhasil diperbarui.' : 'Agenda Acara berhasil ditambahkan.');

        $this->closeForm();
    }

    public function edit($id)
    {
        $event = Event::with(['tags', 'issues'])->findOrFail($id);
        
        $this->event_id = $event->id;
        $this->title = $event->title;
        $this->slug = $event->slug;
        $this->content = $event->content;
        $this->event_date = $event->event_date->format('Y-m-d\TH:i');
        $this->location = $event->location;
        $this->is_published = $event->is_published ? '1' : '0';
        $this->cover_image = $event->cover_image;
        
        $this->selectedTags = $event->tags->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->selectedIssues = $event->issues->pluck('id')->map(fn($id) => (string)$id)->toArray();
        
        $this->isFormOpen = true;
    }

    public function delete($id, ImageService $imageService)
    {
        $event = Event::findOrFail($id);
        
        if ($event->cover_image) {
            $imageService->delete($event->cover_image);
        }

        $event->delete();
        session()->flash('message', 'Agenda Acara berhasil dihapus.');
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
