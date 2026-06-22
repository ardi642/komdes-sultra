<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;

class SettingIndex extends Component
{
    public $tab = 'identitas';

    protected $queryString = ['tab'];

    public function render()
    {
        return view('livewire.admin.setting.setting-index')->layout('layouts.admin');
    }
}
