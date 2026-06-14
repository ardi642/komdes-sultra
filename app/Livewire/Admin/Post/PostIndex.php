<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Issue;
use App\Services\ImageService;
use Illuminate\Support\Str;

class PostIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $isFormOpen = false;
    public $post_id;
    
    // Form fields
    public $title, $slug, $content, $type = 'berita', $category_id;
    public $is_published = true;
    public $cover_image, $new_cover_image;
    
    // Many-to-Many relations
    public $selectedTags = [];
    public $selectedIssues = [];

    #[\Livewire\Attributes\Url]
    public $filterType = '';
    
    #[\Livewire\Attributes\Url]
    public $search = '';
    
    #[\Livewire\Attributes\Url]
    public $filterStatus = ''; // 'published' or 'draft'
    
    #[\Livewire\Attributes\Url]
    public $filterCategory = '';

    #[\Livewire\Attributes\Url]
    public $filterTag = [];
    
    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';

    public $perPage = 10;

    public function updatedFilterType() { $this->resetPage(); }
    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterCategory() { $this->resetPage(); }
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
        $query = Post::with(['category', 'tags', 'issues'])->latest();
        
        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }
        
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }
        
        if ($this->filterStatus === 'published') {
            $query->where('is_published', true);
        } elseif ($this->filterStatus === 'draft') {
            $query->where('is_published', false);
        }

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
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

        return view('livewire.admin.post.post-index', [
            'posts' => $query->paginate($this->perPage),
            'categories' => Category::where('type', $this->type)->get(),
            'allTags' => Tag::orderBy('name')->get(),
            'allIssues' => Issue::where('status', 'active')->orderBy('title')->get(),
        ])->layout('layouts.admin');
    }

    public function updatedType()
    {
        // Reset category if type changes
        $this->category_id = '';
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
        $this->post_id = '';
        $this->title = '';
        $this->slug = '';
        $this->content = '';
        $this->type = $this->filterType ?: 'berita';
        $this->category_id = '';
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
            'slug' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('posts', 'slug')
                    ->where('type', $this->type)
                    ->ignore($this->post_id)
            ],
            'content' => 'required|string',
            'type' => 'required|in:berita,artikel,riset,siaran_pers',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
            'new_cover_image' => 'nullable|image|max:3072', // max 3MB
        ]);

        $postData = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'type' => $this->type,
            'category_id' => $this->category_id ?: null,
            'is_published' => $this->is_published === '1',
        ];

        // Set published_at if publishing for the first time
        if ($this->is_published === '1' && !$this->post_id) {
            $postData['published_at'] = now();
        }

        // Handle Image Upload
        if ($this->new_cover_image) {
            if ($this->post_id && $this->cover_image) {
                $imageService->delete($this->cover_image);
            }
            $postData['cover_image'] = $imageService->upload($this->new_cover_image, 'posts');
        }

        $post = Post::updateOrCreate(['id' => $this->post_id], $postData);

        // Sync Tags and Issues
        $post->tags()->sync($this->selectedTags);
        $post->issues()->sync($this->selectedIssues);

        session()->flash('message', $this->post_id ? 'Publikasi berhasil diperbarui.' : 'Publikasi berhasil ditambahkan.');

        $this->closeForm();
    }

    public function edit($id)
    {
        $post = Post::with(['tags', 'issues'])->findOrFail($id);
        
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->type = $post->type;
        $this->category_id = $post->category_id;
        $this->is_published = $post->is_published ? '1' : '0';
        $this->cover_image = $post->cover_image;
        
        $this->selectedTags = $post->tags->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->selectedIssues = $post->issues->pluck('id')->map(fn($id) => (string)$id)->toArray();
        
        $this->isFormOpen = true;
    }

    public function delete($id, ImageService $imageService)
    {
        $post = Post::findOrFail($id);
        
        if ($post->cover_image) {
            $imageService->delete($post->cover_image);
        }

        $post->delete();
        session()->flash('message', 'Publikasi berhasil dihapus.');
    }

    public function removeCoverImage(ImageService $imageService)
    {
        if ($this->post_id) {
            $post = Post::findOrFail($this->post_id);
            if ($post->cover_image) {
                $imageService->delete($post->cover_image);
                $post->update(['cover_image' => null]);
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
            'type' => $this->type,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'cover_image' => $coverImageUrl,
        ]]);

        $this->dispatch('open-preview-tab');
    }
}
