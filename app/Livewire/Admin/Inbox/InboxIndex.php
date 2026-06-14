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

    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';

    #[\Livewire\Attributes\Url]
    public $filterStatus = '';
    
    public $perPage = 10;

    public function updated($property)
    {
        if (in_array($property, ['search', 'filterYear', 'filterMonth', 'filterStatus', 'perPage'])) {
            $this->resetPage();
        }
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

        if ($this->filterYear) {
            $query->whereYear('created_at', $this->filterYear);
        }

        if ($this->filterMonth) {
            $query->whereMonth('created_at', $this->filterMonth);
        }

        if ($this->filterStatus !== '') {
            $query->where('is_read', $this->filterStatus);
        }

        // Get available years for filter
        $availableYears = Inbox::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('livewire.admin.inbox.inbox-index', [
            'messages' => $query->paginate($this->perPage),
            'availableYears' => $availableYears,
        ])->layout('layouts.admin');
    }
}
