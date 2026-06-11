<?php

namespace App\Livewire\Admin\HeroSlider;

use App\Models\HeroSlider;
use Livewire\Component;

class HeroSliderIndex extends Component
{
    public function render()
    {
        $sliders = HeroSlider::orderBy('order_number')->get();
        return view('livewire.admin.hero-slider.hero-slider-index', compact('sliders'))
            ->layout('layouts.admin');
    }

    public function toggleStatus($id)
    {
        $slider = HeroSlider::findOrFail($id);
        $slider->update(['is_active' => !$slider->is_active]);
    }

    public function delete($id, \App\Services\ImageService $imageService)
    {
        $slider = HeroSlider::findOrFail($id);
        
        // Hapus file gambar
        if ($slider->image_path) {
            $imageService->delete($slider->image_path);
        }
        
        $slider->delete();
    }
}
