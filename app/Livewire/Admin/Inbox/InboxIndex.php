<?php

namespace App\Livewire\Admin\Inbox;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inbox;

class InboxIndex extends Component
{
    use WithPagination;

    public $selectedMessage = null;
    public $isModalOpen = false;

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

    public function viewMessage($id)
    {
        $message = Inbox::findOrFail($id);
        
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        $this->selectedMessage = $message;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedMessage = null;
    }

    public function deleteMessage($id)
    {
        $message = Inbox::findOrFail($id);
        $message->delete();
        
        session()->flash('message', 'Pesan berhasil dihapus.');
        
        if ($this->selectedMessage && $this->selectedMessage->id === $id) {
            $this->closeModal();
        }
    }

    public function render()
    {
        $query = Inbox::latest();
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.inbox.inbox-index', [
            'messages' => $query->paginate($this->perPage),
        ])->layout('layouts.admin');
    }
}
