<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserForm extends Component
{
    public $userId;
    public $name;
    public $email;
    public $posisi;
    public $role = 'Mitra Media'; // Default
    public $password;
    public $password_confirmation;
    public $isEdit = false;

    public function mount($id = null)
    {
        if ($id) {
            $user = User::withTrashed()->findOrFail($id);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->posisi = $user->posisi;
            $this->role = $user->roles->first()?->name ?? 'Mitra Media';
            $this->isEdit = true;
        }
    }

    public function save()
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ($this->userId ? ',' . $this->userId : ''),
            'posisi' => 'nullable|string|max:255',
            'role' => 'required|string|exists:roles,name',
        ];

        if (!$this->isEdit) {
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $this->validate($rules);

        // Security check for role assignment
        if ($this->role === 'Super Admin' && !auth()->user()->hasRole('Super Admin')) {
            session()->flash('error', 'Anda tidak memiliki hak untuk membuat atau mengubah akun menjadi Super Admin.');
            return;
        }

        if ($this->isEdit && $this->userId === 1 && auth()->user()->id !== 1) {
            session()->flash('error', 'Hanya Pemilik Sistem yang dapat mengubah akun ini.');
            return;
        }

        // Prevent Admin from modifying Admin or Super Admin
        if (auth()->user()->hasRole('Admin')) {
            $targetUser = $this->isEdit ? User::withTrashed()->findOrFail($this->userId) : null;
            $targetRole = $this->role;
            
            // If editing, check target user's current role
            if ($this->isEdit && !$targetUser->hasRole('Mitra Media')) {
                session()->flash('error', 'Anda hanya memiliki hak untuk mengubah akun Mitra Media.');
                return;
            }

            // Check the role being assigned
            if ($targetRole !== 'Mitra Media') {
                session()->flash('error', 'Anda hanya dapat memberikan akses sebagai Mitra Media.');
                return;
            }
        }

        if ($this->isEdit) {
            $user = User::withTrashed()->findOrFail($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->posisi = $this->posisi;
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->save();
            $user->syncRoles([$this->role]);

            session()->flash('success', 'Pengguna berhasil diperbarui.');
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'posisi' => $this->posisi,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole($this->role);

            session()->flash('success', 'Pengguna berhasil ditambahkan.');
        }

        return redirect()->route('admin.user.index');
    }

    public function render()
    {
        $availableRoles = Role::query();
        
        // Sembunyikan opsi Super Admin, kecuali jika sedang mengedit akun yang saat ini adalah Super Admin
        if ($this->role !== 'Super Admin') {
            $availableRoles->where('name', '!=', 'Super Admin');
        }

        return view('livewire.admin.user.user-form', [
            'roles' => $availableRoles->get()
        ])->layout('layouts.admin');
    }
}
