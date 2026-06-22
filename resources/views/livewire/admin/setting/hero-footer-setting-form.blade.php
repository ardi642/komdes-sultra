<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Pengaturan Teks Hero & Footer</h2>
            <p class="text-sm text-gray-500 mt-1">Ubah deskripsi yang muncul pada bagian atas (Hero) di berbagai halaman dan pada bagian bawah (Footer).</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('info'))
        <div class="mb-4 bg-blue-50 text-blue-700 p-4 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('info') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Teks Hero: Tentang Kami -->
            <div>
                <label for="hero_about_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Tentang Kami</label>
                <textarea wire:model="hero_about_text" id="hero_about_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Agenda Acara -->
            <div>
                <label for="hero_event_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Agenda Acara</label>
                <textarea wire:model="hero_event_text" id="hero_event_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Fokus Isu -->
            <div>
                <label for="hero_issue_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Fokus Isu</label>
                <textarea wire:model="hero_issue_text" id="hero_issue_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Berita -->
            <div>
                <label for="hero_news_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Berita</label>
                <textarea wire:model="hero_news_text" id="hero_news_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Artikel -->
            <div>
                <label for="hero_article_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Artikel</label>
                <textarea wire:model="hero_article_text" id="hero_article_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Riset & Publikasi -->
            <div>
                <label for="hero_research_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Riset & Publikasi</label>
                <textarea wire:model="hero_research_text" id="hero_research_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Siaran Pers -->
            <div>
                <label for="hero_press_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Siaran Pers</label>
                <textarea wire:model="hero_press_text" id="hero_press_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Hero: Galeri -->
            <div>
                <label for="hero_gallery_text" class="block text-sm font-medium text-gray-700 mb-1">Hero: Galeri</label>
                <textarea wire:model="hero_gallery_text" id="hero_gallery_text" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>

            <!-- Teks Footer -->
            <div>
                <label for="footer_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Footer</label>
                <textarea wire:model="footer_description" id="footer_description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Teks deskripsi..."></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
            <button type="button" wire:click="resetForm" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Batal / Reset
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 inline-flex items-center">
                <svg wire:loading wire:target="store" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="store">Simpan Pengaturan</span>
                <span wire:loading wire:target="store">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
