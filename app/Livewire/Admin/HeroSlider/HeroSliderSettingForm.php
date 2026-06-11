<?php

namespace App\Livewire\Admin\HeroSlider;

use App\Models\HeroSliderSetting;
use Livewire\Component;

class HeroSliderSettingForm extends Component
{
    public $is_autoplay = true;
    public $autoplay_interval = 6000;
    public $animation_duration = 1000;
    public $text_delay = 1000;

    public function mount()
    {
        $setting = HeroSliderSetting::first();
        if ($setting) {
            $this->is_autoplay = $setting->is_autoplay;
            $this->autoplay_interval = $setting->autoplay_interval;
            $this->animation_duration = $setting->animation_duration;
            $this->text_delay = $setting->text_delay;
        }
    }

    public function save()
    {
        $this->validate([
            'is_autoplay' => 'boolean',
            'autoplay_interval' => 'required|integer|min:1000',
            'animation_duration' => 'required|integer|min:300',
            'text_delay' => 'required|integer|min:0',
        ]);

        $setting = HeroSliderSetting::first() ?? new HeroSliderSetting();
        $setting->is_autoplay = $this->is_autoplay;
        $setting->autoplay_interval = $this->autoplay_interval;
        $setting->animation_duration = $this->animation_duration;
        $setting->text_delay = $this->text_delay;
        $setting->save();

        session()->flash('message', 'Pengaturan Slider berhasil disimpan.');
    }

    public function resetToDefault()
    {
        $this->is_autoplay = true;
        $this->autoplay_interval = 6000;
        $this->animation_duration = 1000;
        $this->text_delay = 1000;
        $this->save();
        
        session()->flash('message', 'Pengaturan berhasil dikembalikan ke Standar (Default).');
    }

    public function render()
    {
        return view('livewire.admin.hero-slider.hero-slider-setting-form')
            ->layout('layouts.admin');
    }
}
