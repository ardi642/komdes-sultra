<?php

namespace App\Livewire\Admin\HomepageSetting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\HomepageSetting;
use App\Services\ImageService;

class HomepageSettingForm extends Component
{
    use WithFileUploads;

    public $about_description;
    public $about_media_type = 'none';
    public $about_image_path;
    public $new_about_image;
    public $about_youtube_url;
    
    public $about_btn1_text;
    public $about_btn1_url;
    public $about_btn2_text;
    public $about_btn2_url;
    
    public $network_subtitle;
    public $issue_subtitle;
    public $agenda_subtitle;
    public $publication_subtitle;
    public $gallery_subtitle;

    public function mount()
    {
        $setting = HomepageSetting::first();
        if ($setting) {
            $this->about_description = $setting->about_description;
            $this->about_media_type = $setting->about_media_type;
            $this->about_image_path = $setting->about_image_path;
            $this->about_youtube_url = $setting->about_youtube_url;
            $this->about_btn1_text = $setting->about_btn1_text;
            $this->about_btn1_url = $setting->about_btn1_url;
            $this->about_btn2_text = $setting->about_btn2_text;
            $this->about_btn2_url = $setting->about_btn2_url;
            
            $this->network_subtitle = $setting->network_subtitle;
            $this->issue_subtitle = $setting->issue_subtitle;
            $this->agenda_subtitle = $setting->agenda_subtitle;
            $this->publication_subtitle = $setting->publication_subtitle;
            $this->gallery_subtitle = $setting->gallery_subtitle;
        } else {
            // Default subtitles
            $this->network_subtitle = 'Jejaring komunitas dan organisasi lokal yang bergerak bersama kami.';
            $this->issue_subtitle = 'Isu strategis yang menjadi fokus advokasi dan gerakan kami.';
            $this->agenda_subtitle = 'Ikuti berbagai kegiatan edukasi, diskusi, dan pelatihan bersama kami.';
            $this->publication_subtitle = 'Kabar terbaru, artikel opini, dan laporan riset dari kami.';
            $this->gallery_subtitle = 'Dokumentasi aksi lapangan dan advokasi bersama masyarakat.';
        }
    }

    public function save()
    {
        // Extract src if user pastes iframe code
        if ($this->about_media_type === 'youtube' && $this->about_youtube_url && preg_match('/src="([^"]+)"/', $this->about_youtube_url, $match)) {
            $this->about_youtube_url = $match[1];
        }

        $this->validate([
            'about_description' => 'nullable|string',
            'about_media_type' => 'required|in:none,image,youtube',
            'new_about_image' => 'nullable|image|max:2048',
            'about_youtube_url' => 'nullable|string',
            'about_btn1_text' => 'nullable|string|max:255',
            'about_btn1_url' => 'nullable|string|max:255',
            'about_btn2_text' => 'nullable|string|max:255',
            'about_btn2_url' => 'nullable|string|max:255',
            'network_subtitle' => 'nullable|string|max:255',
            'issue_subtitle' => 'nullable|string|max:255',
            'agenda_subtitle' => 'nullable|string|max:255',
            'publication_subtitle' => 'nullable|string|max:255',
            'gallery_subtitle' => 'nullable|string|max:255',
        ]);

        $setting = HomepageSetting::first() ?? new HomepageSetting();

        if ($this->new_about_image) {
            $imageService = app(ImageService::class);
            if ($setting->about_image_path) {
                $imageService->delete($setting->about_image_path);
            }
            $setting->about_image_path = $imageService->upload($this->new_about_image, 'homepage');
        }

        $setting->about_description = $this->about_description;
        $setting->about_media_type = $this->about_media_type;
        $setting->about_youtube_url = $this->about_youtube_url;
        $setting->about_btn1_text = $this->about_btn1_text;
        $setting->about_btn1_url = $this->about_btn1_url;
        $setting->about_btn2_text = $this->about_btn2_text;
        $setting->about_btn2_url = $this->about_btn2_url;
        
        $setting->network_subtitle = $this->network_subtitle;
        $setting->issue_subtitle = $this->issue_subtitle;
        $setting->agenda_subtitle = $this->agenda_subtitle;
        $setting->publication_subtitle = $this->publication_subtitle;
        $setting->gallery_subtitle = $this->gallery_subtitle;
        
        $setting->save();

        session()->flash('message', 'Pengaturan beranda berhasil disimpan.');
        $this->dispatch('scroll-to-top');
    }

    public function render()
    {
        return view('livewire.admin.homepage-setting.homepage-setting-form')->layout('layouts.admin');
    }
}
