<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    use WithPagination;

    public $name, $slug, $type = 'berita', $category_id;
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
    
    public $perPage = 10;

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
        $query = Category::query();
        
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.category.category-index', [
            'categories' => $query->paginate($this->perPage),
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
        $this->type = 'berita';
        $this->category_id = '';
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->category_id,
            'type' => 'required|string|in:berita,artikel,riset,siaran_pers',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
        ]);

        session()->flash('message', $this->category_id ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->type = $category->type;
        
        $this->openModal();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category->posts()->exists()) {
            session()->flash('error', 'Gagal menghapus: Kategori ini masih digunakan pada publikasi berita.');
            return;
        }
        $category->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    // Batch Delete Methods
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = Category::pluck('id')->map(fn($id) => (string)$id)->toArray();
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
            $category = Category::find($id);
            if ($category) {
                if ($category->posts()->exists()) {
                    $this->deleteFailed++;
                } else {
                    $category->delete();
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
