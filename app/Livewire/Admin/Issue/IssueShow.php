<?php

namespace App\Livewire\Admin\Issue;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Issue;
use App\Models\Post;
use App\Models\Event;

class IssueShow extends Component
{
    use WithPagination;

    public $issue;
    public $postsPerPage = 10;
    public $eventsPerPage = 10;

    public function mount($id)
    {
        $this->issue = Issue::findOrFail($id);
    }

    public function detachPost($postId)
    {
        if ($this->issue) {
            $this->issue->posts()->detach($postId);
            session()->flash('message', 'Publikasi berhasil dikeluarkan dari isu ini.');
        }
    }

    public function detachEvent($eventId)
    {
        if ($this->issue) {
            $this->issue->events()->detach($eventId);
            session()->flash('message', 'Acara berhasil dikeluarkan dari isu ini.');
        }
    }

    public function updatedPostsPerPage()
    {
        $this->resetPage('postsPage');
    }

    public function updatedEventsPerPage()
    {
        $this->resetPage('eventsPage');
    }

    public function render()
    {
        $posts = $this->issue->posts()->latest()->paginate($this->postsPerPage, ['*'], 'postsPage');
        $events = $this->issue->events()->orderBy('event_date', 'desc')->paginate($this->eventsPerPage, ['*'], 'eventsPage');

        return view('livewire.admin.issue.issue-show', [
            'posts' => $posts,
            'events' => $events,
        ])->layout('layouts.admin');
    }
}
