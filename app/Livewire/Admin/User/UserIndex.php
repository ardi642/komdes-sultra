<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class UserIndex extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === 1) {
            session()->flash('error', 'Super Admin tidak dapat dihapus!');
            return;
        }

        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        // Prevent admin from deleting super admin or other admins
        if (auth()->user()->hasRole('Admin') && !$user->hasRole('Mitra Media')) {
            session()->flash('error', 'Anda hanya memiliki hak untuk menghapus akun Mitra Media.');
            return;
        }

        $user->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (auth()->user()->hasRole('Admin') && !$user->hasRole('Mitra Media')) {
            session()->flash('error', 'Anda hanya memiliki hak untuk memulihkan akun Mitra Media.');
            return;
        }

        $user->restore();
        session()->flash('success', 'Pengguna berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->id === 1) {
            session()->flash('error', 'Super Admin tidak dapat dihapus secara permanen!');
            return;
        }

        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        if (auth()->user()->hasRole('Admin') && !$user->hasRole('Mitra Media')) {
            session()->flash('error', 'Anda hanya memiliki hak untuk menghapus akun Mitra Media.');
            return;
        }

        $user->forceDelete();
        session()->flash('success', 'Pengguna berhasil dihapus permanen.');
    }

    public function render()
    {
        $users = User::withTrashed()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user.user-index', [
            'users' => $users
        ])->layout('layouts.admin');
    }
}
