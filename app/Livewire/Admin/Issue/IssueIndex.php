<?php

namespace App\Livewire\Admin\Issue;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Issue;
use App\Services\ImageService;
use Illuminate\Support\Str;

class IssueIndex extends Component
{
    use WithFileUploads;

    public $issues, $issue_id;
    public $title, $slug, $description, $icon_svg, $status = 'active';
    public $cover_image, $new_cover_image;
    
    public $isModalOpen = false;

    public function render()
    {
        $this->issues = Issue::latest()->get();
        return view('livewire.admin.issue.issue-index')
            ->layout('layouts.admin');
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
        
        // Delete the image file from storage
        if ($issue->cover_image) {
            $imageService->delete($issue->cover_image);
        }

        $issue->delete();
        session()->flash('message', 'Isu Kampanye berhasil dihapus.');
    }
}
