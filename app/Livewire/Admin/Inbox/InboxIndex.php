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
        return view('livewire.admin.inbox.inbox-index', [
            'messages' => Inbox::latest()->paginate(15),
        ])->layout('layouts.admin');
    }
}
