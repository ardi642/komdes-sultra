<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class ProfileIndex extends Component
{
    public $name;
    public $email;
    public $posisi;

    public $current_password;
    public $password;
    public $password_confirmation;
    public $profile_current_password;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->posisi = $user->posisi;
    }

    public function updateProfile(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        // Jika email diubah, wajib verifikasi menggunakan kata sandi saat ini
        if ($this->email !== auth()->user()->email) {
            $this->validate([
                'profile_current_password' => ['required', 'string', 'current_password:web'],
            ], [
                'profile_current_password.required' => 'Kata sandi saat ini wajib diisi untuk mengubah email.',
                'profile_current_password.current_password' => 'Kata sandi saat ini tidak cocok.',
            ]);
        }

        $updater->update(auth()->user(), [
            'name' => $this->name,
            'email' => $this->email,
            'posisi' => $this->posisi,
        ]);

        $this->profile_current_password = null;

        session()->flash('profile_message', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update(auth()->user(), [
            'current_password' => $this->current_password,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('password_message', 'Kata sandi berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.profile.profile-index')
            ->layout('layouts.admin');
    }
}
