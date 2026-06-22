<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagIndex extends Component
{
    use WithPagination;

    public $name, $slug, $tag_id;
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
    public $filterAuthor = '';
    
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterAuthor()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Tag::with('user');
        
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filterAuthor) {
            $query->where('user_id', $this->filterAuthor);
        }

        return view('livewire.admin.tag.tag-index', [
            'tags' => $query->paginate($this->perPage),
            'authors' => \App\Models\User::orderBy('name')->get(),
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
        $this->name = '';
        $this->slug = '';
        $this->tag_id = '';
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $this->tag_id,
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
        ];

        if (!$this->tag_id) {
            $data['user_id'] = auth()->id();
        }

        Tag::updateOrCreate(['id' => $this->tag_id], $data);

        session()->flash('message', $this->tag_id ? 'Tag berhasil diperbarui.' : 'Tag berhasil ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $tag->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengubah tag ini.');
            return;
        }

        $this->tag_id = $id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        
        $this->openModal();
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $tag->user_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus tag ini.');
            return;
        }

        if ($tag->posts()->exists() || $tag->events()->exists()) {
            session()->flash('error', 'Gagal menghapus: Tag ini masih digunakan pada publikasi atau acara.');
            return;
        }
        $tag->delete();
        session()->flash('message', 'Tag berhasil dihapus.');
    }

    // Batch Delete Methods
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = Tag::query();
            if ($this->search) $query->where('name', 'like', '%' . $this->search . '%');
            if ($this->filterAuthor) $query->where('user_id', $this->filterAuthor);
            
            $this->selectedItems = $query->paginate($this->perPage)->pluck('id')->map(fn($id) => (string)$id)->toArray();
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

    public function processNextChunk()
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
            $tag = Tag::find($id);
            if ($tag) {
                if (auth()->user()->hasRole('Mitra Media') && $tag->user_id !== auth()->id()) {
                    $this->deleteFailed++;
                    continue;
                }
                
                if ($tag->posts()->exists() || $tag->events()->exists()) {
                    $this->deleteFailed++;
                } else {
                    $tag->delete();
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
