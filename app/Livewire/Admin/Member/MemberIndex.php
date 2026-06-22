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
    public $name, $description, $address, $email, $phone, $website, $instagram, $facebook, $twitter, $tiktok, $youtube, $linkedin;
    public $order_number = 0;
    public $is_active = true;
    public $logo, $new_logo;
    
    #[\Livewire\Attributes\Url]
    public $search = '';

    #[\Livewire\Attributes\Url]
    public $filterStatus = '';
    
    #[\Livewire\Attributes\Url]
    public $filterYear = '';

    #[\Livewire\Attributes\Url]
    public $filterMonth = '';
    
    public $perPage = 10;

    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterYear() { $this->resetPage(); }
    public function updatedFilterMonth() { $this->resetPage(); }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Member::orderBy('order_number');
        
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus === 'active') {
            $query->where('is_active', true);
        } elseif ($this->filterStatus === 'inactive') {
            $query->where('is_active', false);
        }

        if ($this->filterYear) {
            $query->whereYear('created_at', $this->filterYear);
        }

        if ($this->filterMonth) {
            $query->whereMonth('created_at', $this->filterMonth);
        }

        return view('livewire.admin.member.member-index', [
            'members' => $query->paginate($this->perPage),
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
        $this->facebook = '';
        $this->twitter = '';
        $this->tiktok = '';
        $this->youtube = '';
        $this->linkedin = '';
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
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
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
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
            'is_active' => $this->is_active,
        ];

        // Handle Image Upload
        if ($this->new_logo) {
            if ($this->member_id && $this->logo) {
                $imageService->delete($this->logo);
            }
            $data['logo'] = $imageService->upload($this->new_logo, 'members');
        }

        if (!$this->member_id) {
            $data['order_number'] = Member::max('order_number') + 1;
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
        $this->facebook = $member->facebook;
        $this->twitter = $member->twitter;
        $this->tiktok = $member->tiktok;
        $this->youtube = $member->youtube;
        $this->linkedin = $member->linkedin;
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

    public function updateOrder($orderedIds)
    {
        $startOrder = ($this->getPage() - 1) * $this->perPage + 1;
        
        foreach ($orderedIds as $index => $id) {
            Member::where('id', $id)->update(['order_number' => $startOrder + $index]);
        }
        
        session()->flash('message', 'Urutan anggota berhasil diperbarui.');
    }
}
