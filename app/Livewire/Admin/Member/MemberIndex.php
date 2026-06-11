<?php

namespace App\Livewire\Admin\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Member;
use App\Services\ImageService;

class MemberIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $isFormOpen = false;
    public $member_id;
    
    // Form fields
    public $name, $description, $address, $email, $phone, $website, $instagram;
    public $order_number = 0;
    public $is_active = true;
    public $logo, $new_logo;
    
    public function render()
    {
        return view('livewire.admin.member.member-index', [
            'members' => Member::orderBy('order_number')->paginate(10),
        ])->layout('layouts.admin');
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
        $this->member_id = '';
        $this->name = '';
        $this->description = '';
        $this->address = '';
        $this->email = '';
        $this->phone = '';
        $this->website = '';
        $this->instagram = '';
        $this->order_number = 0;
        $this->is_active = true;
        $this->logo = null;
        $this->new_logo = null;
    }

    public function store(ImageService $imageService)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'order_number' => 'required|integer',
            'is_active' => 'boolean',
            'new_logo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'instagram' => $this->instagram,
            'order_number' => $this->order_number,
            'is_active' => $this->is_active,
        ];

        // Handle Image Upload
        if ($this->new_logo) {
            if ($this->member_id && $this->logo) {
                $imageService->delete($this->logo);
            }
            $data['logo'] = $imageService->upload($this->new_logo, 'members');
        }

        Member::updateOrCreate(['id' => $this->member_id], $data);

        session()->flash('message', $this->member_id ? 'Anggota berhasil diperbarui.' : 'Anggota berhasil ditambahkan.');

        $this->closeForm();
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        
        $this->member_id = $member->id;
        $this->name = $member->name;
        $this->description = $member->description;
        $this->address = $member->address;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->website = $member->website;
        $this->instagram = $member->instagram;
        $this->order_number = $member->order_number;
        $this->is_active = (bool) $member->is_active;
        $this->logo = $member->logo;
        
        $this->isFormOpen = true;
    }

    public function delete($id, ImageService $imageService)
    {
        $member = Member::findOrFail($id);
        
        if ($member->logo) {
            $imageService->delete($member->logo);
        }

        $member->delete();
        session()->flash('message', 'Anggota berhasil dihapus.');
    }
}
