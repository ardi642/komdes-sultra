<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\About;

class AboutIndex extends Component
{
    public $about_id;
    public $profil_singkat;
    public $mengapa_komdes;
    public $tujuan_quote;
    
    // Arrays for dynamic lists
    public $tujuan_list = [];
    public $intensi_list = [];
    public $sikap_list = [];

    public function mount()
    {
        $about = About::first();
        
        if (!$about) {
            $about = new About();
            $about->id = 1;
        }
        
        $this->about_id = $about->id;
        $this->profil_singkat = $about->profil_singkat ?? 'Komdes Sultra didirikan atas dasar kepedulian terhadap kelestarian ekosistem dan kesejahteraan masyarakat. Organisasi ini percaya bahwa kolaborasi dan edukasi adalah kunci utama untuk menjaga keseimbangan alam sekaligus memajukan kemandirian ekonomi.';
        $this->mengapa_komdes = $about->mengapa_komdes ?? 'Komdes Sultra hadir sebagai jembatan penghubung antara masyarakat akar rumput, pemerintah, dan pemangku kepentingan lainnya. Dengan komitmen pada pembangunan yang inklusif, Komdes Sultra berupaya menginisiasi program-program berkelanjutan yang memberikan dampak positif secara langsung bagi lingkungan dan masyarakat luas.';
        $this->tujuan_quote = $about->tujuan_quote ?? '"Melangkah bersama masyarakat, menjaga kelestarian alam, dan mewujudkan kesejahteraan yang berkelanjutan dan berkeadilan."';
        $this->tujuan_list = is_array($about->tujuan_list) ? $about->tujuan_list : [];
        $this->intensi_list = is_array($about->intensi_list) ? $about->intensi_list : [];
        $this->sikap_list = is_array($about->sikap_list) ? $about->sikap_list : [];
        
        // Default empty item if empty
        if (empty($this->tujuan_list)) $this->tujuan_list[] = '';
        if (empty($this->intensi_list)) $this->intensi_list[] = '';
        if (empty($this->sikap_list)) $this->sikap_list[] = ['title' => '', 'description' => ''];
    }

    public function addTujuan() { $this->tujuan_list[] = ''; }
    public function removeTujuan($index) { unset($this->tujuan_list[$index]); $this->tujuan_list = array_values($this->tujuan_list); }

    public function addIntensi() { $this->intensi_list[] = ''; }
    public function removeIntensi($index) { unset($this->intensi_list[$index]); $this->intensi_list = array_values($this->intensi_list); }

    public function addSikap() { $this->sikap_list[] = ['title' => '', 'description' => '']; }
    public function removeSikap($index) { unset($this->sikap_list[$index]); $this->sikap_list = array_values($this->sikap_list); }

    public function store()
    {
        $this->validate([
            'profil_singkat' => 'nullable|string',
            'mengapa_komdes' => 'nullable|string',
            'tujuan_quote' => 'nullable|string',
            'tujuan_list.*' => 'required|string',
            'intensi_list.*' => 'required|string',
            'sikap_list.*.title' => 'required|string',
            'sikap_list.*.description' => 'required|string',
        ], [
            'tujuan_list.*.required' => 'Poin tujuan tidak boleh kosong.',
            'intensi_list.*.required' => 'Poin intensi tidak boleh kosong.',
            'sikap_list.*.title.required' => 'Judul sikap tidak boleh kosong.',
            'sikap_list.*.description.required' => 'Deskripsi sikap tidak boleh kosong.',
        ]);

        $about = About::find($this->about_id);
        $about->update([
            'profil_singkat' => $this->profil_singkat,
            'mengapa_komdes' => $this->mengapa_komdes,
            'tujuan_quote' => $this->tujuan_quote,
            'tujuan_list' => array_values($this->tujuan_list),
            'intensi_list' => array_values($this->intensi_list),
            'sikap_list' => array_values($this->sikap_list),
        ]);

        session()->flash('message', 'Pengaturan Tentang Kami berhasil disimpan.');
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
        return view('livewire.admin.setting.about-index')->layout('layouts.admin');
    }
}
