<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\SiteSetting;

class HeroFooterSettingForm extends Component
{
    public $hero_about_text;
    public $hero_event_text;
    public $hero_news_text;
    public $hero_issue_text;
    public $hero_article_text;
    public $hero_research_text;
    public $hero_press_text;
    public $hero_gallery_text;
    public $footer_description;

    public function mount()
    {
        $this->hero_about_text = SiteSetting::where('key', 'hero_about_text')->value('value') ?? 'Mengenal lebih dekat visi dan arah pergerakan Komdes Sultra.';
        $this->hero_news_text = SiteSetting::where('key', 'hero_news_text')->value('value') ?? 'Kabar terkini seputar pelaksanaan kegiatan Komdes Sultra.';
        $this->hero_event_text = SiteSetting::where('key', 'hero_event_text')->value('value') ?? 'Informasi detail terkait agenda kegiatan Komdes Sultra.';
        $this->hero_issue_text = SiteSetting::where('key', 'hero_issue_text')->value('value') ?? 'Berbagai isu strategis yang menjadi fokus utama gerakan Komdes Sultra.';
        $this->hero_article_text = SiteSetting::where('key', 'hero_article_text')->value('value') ?? 'Kumpulan tulisan, gagasan, dan cerita menarik dari perjalanan Komdes Sultra.';
        $this->hero_research_text = SiteSetting::where('key', 'hero_research_text')->value('value') ?? 'Laporan dan dokumentasi hasil riset Komdes Sultra.';
        $this->hero_press_text = SiteSetting::where('key', 'hero_press_text')->value('value') ?? 'Pernyataan resmi, sikap kelembagaan, dan informasi terkini terkait respons Komdes Sultra terhadap isu-isu publik.';
        $this->hero_gallery_text = SiteSetting::where('key', 'hero_gallery_text')->value('value') ?? 'Kumpulan foto dokumentasi kegiatan Komdes Sultra.';
        $this->footer_description = SiteSetting::where('key', 'footer_description')->value('value') ?? 'Komunitas Masyarakat Desa-Sulawesi Tenggara (Komdes Sultra) berdedikasi untuk memberdayakan masyarakat dan menjaga kelestarian lingkungan demi masa depan yang berkelanjutan.';
    }

    public function store()
    {
        $this->validate([
            'hero_about_text' => 'nullable|string',
            'hero_news_text' => 'nullable|string',
            'hero_event_text' => 'nullable|string',
            'hero_issue_text' => 'nullable|string',
            'hero_article_text' => 'nullable|string',
            'hero_research_text' => 'nullable|string',
            'hero_press_text' => 'nullable|string',
            'hero_gallery_text' => 'nullable|string',
            'footer_description' => 'nullable|string',
        ]);

        $settings = [
            'hero_about_text' => $this->hero_about_text,
            'hero_news_text' => $this->hero_news_text,
            'hero_event_text' => $this->hero_event_text,
            'hero_issue_text' => $this->hero_issue_text,
            'hero_article_text' => $this->hero_article_text,
            'hero_research_text' => $this->hero_research_text,
            'hero_press_text' => $this->hero_press_text,
            'hero_gallery_text' => $this->hero_gallery_text,
            'footer_description' => $this->footer_description,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        session()->flash('message', 'Pengaturan teks hero dan footer berhasil disimpan.');
        $this->dispatch('scroll-to-top');
    }

    public function resetForm()
    {
        $this->mount();
        session()->flash('info', 'Formulir telah dikembalikan ke data terakhir yang tersimpan.');
        $this->dispatch('scroll-to-top');
    }

    public function render()
    {
        return view('livewire.admin.setting.hero-footer-setting-form');
    }
}
