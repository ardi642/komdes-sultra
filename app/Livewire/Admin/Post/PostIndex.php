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
    public $bulkSelectedCategory = '';
    
    // Form fields
    public $title, $slug, $content, $type = 'berita', $category_id;
    public $is_published = true;
    public $cover_image, $new_cover_image;
    
    // Manual Archive Date
    public $is_manual_archive = false;
    public $archive_date;

    // Many-to-Many relations
    public $selectedTags = [];
    public $selectedIssues = '';

    public $filterType = '';
    
    #[\Livewire\Attributes\Url]
    public $search = '';
    
    #[\Livewire\Attributes\Url]
    public $filterStatus = ''; // 'published' or 'draft'
    
    #[\Livewire\Attributes\Url]
    public $filterCategory = '';

    #[\Livewire\Attributes\Url]
    public $filterAuthor = '';

    #[\Livewire\Attributes\Url]
    public $filterTag = [];
    
    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';

    public $perPage = 10;

    public function mount($filterType = 'berita')
    {
        // Ubah siaran-pers menjadi siaran_pers untuk kecocokan ke database
        $this->filterType = str_replace('-', '_', $filterType);
    }

    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterCategory() { $this->resetPage(); }
    public function updatedFilterAuthor() { $this->resetPage(); }
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
        $query = Post::with(['category', 'tags', 'issues', 'author'])->latest();
        
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

        if ($this->filterAuthor) {
            $query->where('author_id', $this->filterAuthor);
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

        $posts = $query->paginate($this->perPage);

        $availableYears = Post::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter()
            ->toArray();

        // Ensure at least current year is in the array if empty
        if (empty($availableYears)) {
            $availableYears = [date('Y')];
        }

        return view('livewire.admin.post.post-index', [
            'posts' => $posts,
            'categories' => Category::where('type', $this->filterType ?: 'berita')->get(),
            'allTags' => Tag::orderBy('name')->get(),
            'allIssues' => Issue::where('status', 'active')->orderBy('title')->get(),
            'authors' => \App\Models\User::orderBy('name')->get(),
            'availableYears' => $availableYears,
        ])->layout('layouts.admin');
    }
    
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = Post::latest();
            if ($this->filterType) $query->where('type', $this->filterType);
            if ($this->search) $query->where('title', 'like', '%' . $this->search . '%');
            if ($this->filterStatus === 'published') $query->where('is_published', true);
            elseif ($this->filterStatus === 'draft') $query->where('is_published', false);
            if ($this->filterCategory) $query->where('category_id', $this->filterCategory);
            if ($this->filterAuthor) $query->where('author_id', $this->filterAuthor);
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
        $this->is_manual_archive = false;
        $this->archive_date = null;
        $this->selectedTags = [];
        $this->selectedIssues = '';
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

        if (!$this->post_id) {
            $postData['author_id'] = auth()->id();
        }

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

        // Update created_at and published_at if manual archive is active
        if ($this->is_manual_archive && $this->archive_date) {
            $post->created_at = $this->archive_date;
            if ($post->is_published) {
                $post->published_at = $this->archive_date;
            }
            $post->save(['timestamps' => false]);
        }

        // Sync Tags and Issues
        $post->tags()->sync($this->selectedTags);
        $post->issues()->sync($this->selectedIssues ? [$this->selectedIssues] : []);

        session()->flash('message', $this->post_id ? 'Publikasi berhasil diperbarui.' : 'Publikasi berhasil ditambahkan.');

        $this->closeForm();
    }

    public function edit($id)
    {
        $post = Post::with(['tags', 'issues'])->findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $post->author_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk mengubah tulisan ini.');
            return;
        }
        
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->type = $post->type;
        $this->category_id = $post->category_id;
        $this->is_published = $post->is_published ? '1' : '0';
        $this->cover_image = $post->cover_image;
        
        $this->is_manual_archive = false;
        $this->archive_date = $post->created_at ? $post->created_at->format('Y-m-d\TH:i') : null;
        
        $this->selectedTags = $post->tags->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->selectedIssues = $post->issues->first()?->id ?? '';
        
        $this->isFormOpen = true;
    }

    public function delete($id, ImageService $imageService)
    {
        $post = Post::findOrFail($id);
        
        if (auth()->user()->hasRole('Mitra Media') && $post->author_id !== auth()->id()) {
            session()->flash('error', 'Anda tidak memiliki hak untuk menghapus tulisan ini.');
            return;
        }
        
        if ($post->cover_image) {
            $imageService->delete($post->cover_image);
        }

        $post->delete();
        session()->flash('message', 'Publikasi berhasil dihapus.');
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
        
        $posts = Post::whereIn('id', $currentChunk)->get();
        foreach ($posts as $post) {
            try {
                if (auth()->user()->hasRole('Mitra Media') && $post->author_id !== auth()->id()) {
                    $this->deleteFailed++;
                    $this->deleteProcessed++;
                    continue;
                }
                
                if ($post->cover_image) {
                    $imageService->delete($post->cover_image);
                }
                $post->delete();
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
        $this->bulkSelectedCategory = '';
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
            $posts = Post::whereIn('id', $this->selectedItems)->get();

            foreach ($posts as $post) {
                if (auth()->user()->hasRole('Mitra Media') && $post->author_id !== auth()->id()) {
                    continue;
                }

                // Category Update
                if (!empty($this->bulkSelectedCategory)) {
                    $post->update(['category_id' => $this->bulkSelectedCategory]);
                }

                // Tags Update
                if (!empty($this->bulkSelectedTags)) {
                    if ($this->bulkEditAction === 'replace') {
                        $post->tags()->sync($this->bulkSelectedTags);
                    } else {
                        $post->tags()->syncWithoutDetaching($this->bulkSelectedTags);
                    }
                } elseif ($this->bulkEditAction === 'replace') {
                    $post->tags()->detach();
                }

                // Issues Update
                if (!empty($this->bulkSelectedIssues)) {
                    $post->issues()->sync([$this->bulkSelectedIssues]);
                }
            }
        });

        $this->selectedItems = [];
        $this->selectAll = false;
        $this->closeBulkEditModal();
        session()->flash('message', 'Label pada tulisan terpilih berhasil diperbarui.');
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
