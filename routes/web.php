<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tentang-kami', [FrontendController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/anggota', [FrontendController::class, 'anggota'])->name('anggota');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/berita/{post:slug}', [FrontendController::class, 'postDetail'])->name('berita.detail');

Route::get('/artikel', [FrontendController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{post:slug}', [FrontendController::class, 'postDetail'])->name('artikel.detail');

Route::get('/acara', [FrontendController::class, 'acara'])->name('acara');
Route::get('/acara/{event:slug}', [FrontendController::class, 'eventDetail'])->name('acara.detail');

Route::get('/riset', [FrontendController::class, 'riset'])->name('riset');
Route::view('/riset/kategori', 'pages.riset-kategori')->name('riset.kategori'); // Nanti bisa disesuaikan jika perlu
Route::get('/riset/{post:slug}', [FrontendController::class, 'postDetail'])->name('riset.detail');

Route::get('/siaran-pers', [FrontendController::class, 'siaranPers'])->name('siaran-pers');
Route::get('/siaran-pers/{post:slug}', [FrontendController::class, 'postDetail'])->name('siaran-pers.detail');

Route::get('/isu', [FrontendController::class, 'isu'])->name('isu');
Route::get('/isu/{issue:slug}', [FrontendController::class, 'issueDetail'])->name('isu.detail');

Route::get('/kontak', [FrontendController::class, 'kontak'])->name('kontak');
Route::post('/kontak/kirim', [FrontendController::class, 'kirimPesan'])->name('kontak.kirim');

Route::get('/galeri', [FrontendController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{slug}', [FrontendController::class, 'galeriDetail'])->name('galeri.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Admin Routes (Livewire)
Route::prefix('admin')->name('admin.')->group(function () {
    // We will apply auth middleware later, for development we can access directly or add later.
    Route::get('/kategori', \App\Livewire\Admin\Category\CategoryIndex::class)->name('category.index');
    Route::get('/tag', \App\Livewire\Admin\Tag\TagIndex::class)->name('tag.index');
    Route::get('/isu', \App\Livewire\Admin\Issue\IssueIndex::class)->name('issue.index');
    Route::get('/tulisan', \App\Livewire\Admin\Post\PostIndex::class)->name('post.index');
    Route::get('/acara', \App\Livewire\Admin\Event\EventIndex::class)->name('event.index');


    // Hero Slider
    Route::get('/hero-slider', \App\Livewire\Admin\HeroSlider\HeroSliderIndex::class)->name('hero.index');
    Route::get('/hero-slider/pengaturan', \App\Livewire\Admin\HeroSlider\HeroSliderSettingForm::class)->name('hero.setting');
    Route::get('/hero-slider/tambah', \App\Livewire\Admin\HeroSlider\HeroSliderForm::class)->name('hero.create');
    Route::get('/hero-slider/{id}/edit', \App\Livewire\Admin\HeroSlider\HeroSliderForm::class)->name('hero.edit');


    Route::get('/galeri', \App\Livewire\Admin\Gallery\GalleryIndex::class)->name('gallery.index');
    Route::get('/galeri/tambah', \App\Livewire\Admin\Gallery\GalleryForm::class)->name('gallery.create');
    Route::get('/galeri/{id}/edit', \App\Livewire\Admin\Gallery\GalleryForm::class)->name('gallery.edit');
    Route::get('/anggota', \App\Livewire\Admin\Member\MemberIndex::class)->name('member.index');
    Route::get('/pengaturan-beranda', \App\Livewire\Admin\HomepageSetting\HomepageSettingForm::class)->name('homepage.setting');
    Route::get('/tentang-kami', \App\Livewire\Admin\Setting\AboutIndex::class)->name('about.index');
    Route::get('/kontak', \App\Livewire\Admin\Setting\ContactIndex::class)->name('contact.index');
    Route::get('/pesan-masuk', \App\Livewire\Admin\Inbox\InboxIndex::class)->name('inbox.index');
});

require __DIR__.'/settings.php';
