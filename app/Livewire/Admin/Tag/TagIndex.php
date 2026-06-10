<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagIndex extends Component
{
    public $tags, $name, $slug, $tag_id;
    public $isModalOpen = false;

    public function render()
    {
        $this->tags = Tag::all();
        return view('livewire.admin.tag.tag-index')
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

        Tag::updateOrCreate(['id' => $this->tag_id], [
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        session()->flash('message', $this->tag_id ? 'Tag berhasil diperbarui.' : 'Tag berhasil ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tag_id = $id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        
        $this->openModal();
    }

    public function delete($id)
    {
        Tag::find($id)->delete();
        session()->flash('message', 'Tag berhasil dihapus.');
    }
}
