<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ContactSetting;
use App\Services\ImageService;

class ContactIndex extends Component
{
    use WithFileUploads;

    public $setting_id;
    public $phone;
    public $email;
    public $website;
    public $address;
    public $logo;
    public $new_logo;

    public function mount()
    {
        $setting = ContactSetting::firstOrCreate(['id' => 1], [
            'phone' => '082290533640',
            'email' => 'kantor@jaringnusa.id',
            'website' => 'jaringnusa.id',
            'address' => 'Perumahan Bumi Pesona Pelangi, Jl. Kuning No.15, Minasa Upa, Kec. Rappocini, Kota Makassar, Sulawesi Selatan, 90221',
            'logo' => null,
        ]);

        $this->setting_id = $setting->id;
        $this->phone = $setting->phone;
        $this->email = $setting->email;
        $this->website = $setting->website;
        $this->address = $setting->address;
        $this->logo = $setting->logo;
    }

    public function store(ImageService $imageService)
    {
        $this->validate([
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'new_logo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $setting = ContactSetting::find($this->setting_id);
        
        $data = [
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'address' => $this->address,
        ];

        // Handle Image Upload
        if ($this->new_logo) {
            if ($setting->logo) {
                $imageService->delete($setting->logo);
            }
            $data['logo'] = $imageService->upload($this->new_logo, 'settings');
            $this->logo = $data['logo'];
        }

        $setting->update($data);

        $this->new_logo = null;

        session()->flash('message', 'Pengaturan Kontak Utama berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.setting.contact-index')->layout('layouts.admin');
    }
}
