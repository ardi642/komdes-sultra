<?php

namespace App\Livewire\Admin\HeroSlider;

use App\Models\HeroSlider;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeroSliderForm extends Component
{
    use WithFileUploads;

    public $sliderId;
    public $title, $subtitle, $btn1_text, $btn1_url, $btn2_text, $btn2_url, $order_number;
    public $image_path; // file input baru
    public $old_image; // path lama

    public function mount($id = null)
    {
        if ($id) {
            $slider = HeroSlider::findOrFail($id);
            $this->sliderId = $slider->id;
            $this->title = $slider->title;
            $this->subtitle = $slider->subtitle;
            $this->btn1_text = $slider->btn1_text;
            $this->btn1_url = $slider->btn1_url;
            $this->btn2_text = $slider->btn2_text;
            $this->btn2_url = $slider->btn2_url;
            $this->order_number = $slider->order_number;
            $this->old_image = $slider->image_path;
        } else {
            $this->order_number = HeroSlider::max('order_number') + 1;
        }
    }

    public function render()
    {
        return view('livewire.admin.hero-slider.hero-slider-form')
            ->layout('layouts.admin');
    }

    public function save(\App\Services\ImageService $imageService)
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'btn1_text' => 'nullable|string|max:255',
            'btn1_url' => 'nullable|string|max:255',
            'btn2_text' => 'nullable|string|max:255',
            'btn2_url' => 'nullable|string|max:255',
            'order_number' => 'required|integer',
        ];

        if (!$this->sliderId) {
            $rules['image_path'] = 'required|image|max:3072'; // max 3MB
        } else {
            $rules['image_path'] = 'nullable|image|max:3072';
        }

        $this->validate($rules);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'btn1_text' => $this->btn1_text,
            'btn1_url' => $this->btn1_url,
            'btn2_text' => $this->btn2_text,
            'btn2_url' => $this->btn2_url,
            'order_number' => $this->order_number,
        ];

        if ($this->image_path) {
            $data['image_path'] = $imageService->upload($this->image_path, 'hero-sliders');

            // Hapus gambar lama jika ada
            if ($this->sliderId && $this->old_image) {
                $imageService->delete($this->old_image);
            }
        }

        if ($this->sliderId) {
            HeroSlider::find($this->sliderId)->update($data);
        } else {
            HeroSlider::create($data);
        }

        session()->flash('message', 'Slider beranda berhasil disimpan.');
        return redirect()->route('admin.hero.index');
    }
}
