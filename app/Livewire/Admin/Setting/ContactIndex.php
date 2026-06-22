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
    public $site_name;
    public $site_name_segments = [];
    public $favicon;
    public $new_favicon;
    public $phone;
    public $email;
    public $website;
    public $address;
    public $logo;
    public $new_logo;
    
    public $footer_description;
    public $facebook_url;
    public $instagram_url;
    public $twitter_url;
    public $tiktok_url;
    public $youtube_url;
    public $linkedin_url;

    public function mount()
    {
        $setting = ContactSetting::firstOrCreate(['id' => 1], [
            'site_name' => 'Komdes Sultra',
            'site_name_segments' => [
                ['text' => 'Komdes', 'color' => '#ffffff'],
                ['text' => 'Sultra', 'color' => '#FFD700']
            ],
            'phone' => '082290533640',
            'email' => 'kantor@jaringnusa.id',
            'website' => 'jaringnusa.id',
            'address' => 'Perumahan Bumi Pesona Pelangi, Jl. Kuning No.15, Minasa Upa, Kec. Rappocini, Kota Makassar, Sulawesi Selatan, 90221',
            'logo' => null,
            'footer_description' => 'Lembaga Swadaya Masyarakat yang berdedikasi untuk pemberdayaan komunitas desa di Sulawesi Tenggara melalui advokasi, riset, dan program berkelanjutan.',
        ]);

        $this->setting_id = $setting->id;
        $this->site_name = $setting->site_name;
        $this->site_name_segments = $setting->site_name_segments ?? [
            ['text' => 'Komdes', 'color' => '#ffffff'],
            ['text' => 'Sultra', 'color' => '#FFD700']
        ];
        $this->favicon = $setting->favicon;
        $this->phone = $setting->phone;
        $this->email = $setting->email;
        $this->website = $setting->website;
        $this->address = $setting->address;
        $this->logo = $setting->logo;
        $this->footer_description = $setting->footer_description;
        $this->facebook_url = $setting->facebook_url;
        $this->instagram_url = $setting->instagram_url;
        $this->twitter_url = $setting->twitter_url;
        $this->tiktok_url = $setting->tiktok_url;
        $this->youtube_url = $setting->youtube_url;
        $this->linkedin_url = $setting->linkedin_url;
    }

    public function addSegment()
    {
        $this->site_name_segments[] = ['text' => '', 'color' => '#ffffff'];
    }

    public function removeSegment($index)
    {
        unset($this->site_name_segments[$index]);
        $this->site_name_segments = array_values($this->site_name_segments); // Reindex array
    }

    public function store(ImageService $imageService)
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'site_name_segments' => 'nullable|array',
            'site_name_segments.*.text' => 'nullable|string|max:255',
            'site_name_segments.*.color' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'new_logo' => 'nullable|image|max:2048', // max 2MB
            'new_favicon' => 'nullable|image|max:1024', // max 1MB
            'footer_description' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        $setting = ContactSetting::find($this->setting_id);
        
        $data = [
            'site_name' => $this->site_name,
            'site_name_segments' => $this->site_name_segments,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'address' => $this->address,
            'footer_description' => $this->footer_description,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'twitter_url' => $this->twitter_url,
            'tiktok_url' => $this->tiktok_url,
            'youtube_url' => $this->youtube_url,
            'linkedin_url' => $this->linkedin_url,
        ];

        // Handle Logo Upload
        if ($this->new_logo) {
            if ($setting->logo) {
                $imageService->delete($setting->logo);
            }
            $data['logo'] = $imageService->upload($this->new_logo, 'settings');
            $this->logo = $data['logo'];
        }

        // Handle Favicon Upload
        if ($this->new_favicon) {
            if ($setting->favicon) {
                $imageService->delete($setting->favicon);
            }
            $data['favicon'] = $imageService->upload($this->new_favicon, 'settings');
            $this->favicon = $data['favicon'];
        }

        $setting->update($data);

        $this->new_logo = null;
        $this->new_favicon = null;

        session()->flash('message', 'Pengaturan kontak dan identitas berhasil diperbarui.');
        $this->dispatch('scroll-to-top');
    }

    public function render()
    {
        return view('livewire.admin.setting.contact-index')->layout('layouts.admin');
    }
}
