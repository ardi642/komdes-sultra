<div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900">Pengaturan Animasi Slider</h1>
            <p class="text-sm text-zinc-500 mt-1">Konfigurasi perilaku putaran otomatis dan kecepatan transisi UI.</p>
        </div>
        <a href="{{ route('admin.hero.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-semibold text-xs text-zinc-700 uppercase tracking-widest hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition shadow-sm w-fit">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <form wire:submit.prevent="save" class="p-6">
            <div class="space-y-6">
                <!-- Autoplay Switch -->
                <div class="flex items-center justify-between border-b border-zinc-100 pb-6">
                    <div>
                        <h3 class="text-lg font-medium text-zinc-900">Putar Otomatis (Autoplay)</h3>
                        <p class="text-sm text-zinc-500">Aktifkan untuk membuat slider berganti gambar secara otomatis.</p>
                    </div>
                    <button type="button" wire:click="$toggle('is_autoplay')" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $is_autoplay ? 'bg-primary-600' : 'bg-zinc-200' }}">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $is_autoplay ? 'translate-x-6' : 'translate-x-1' }}"></span>
                    </button>
                </div>

                <!-- Intervals and Delays -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1">Durasi Tampil per Gambar (ms)</label>
                        <input type="number" wire:model="autoplay_interval" class="w-full rounded-lg border-zinc-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Misal: 6000" {{ !$is_autoplay ? 'disabled' : '' }}>
                        <p class="mt-1 text-xs text-zinc-500">Satu detik = 1000 ms. Default: 6000 (6 detik).</p>
                        @error('autoplay_interval') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1">Kecepatan Transisi Gambar (ms)</label>
                        <input type="number" wire:model="animation_duration" class="w-full rounded-lg border-zinc-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Misal: 1000">
                        <p class="mt-1 text-xs text-zinc-500">Waktu yang dibutuhkan untuk bergeser. Default: 1000 (1 detik).</p>
                        @error('animation_duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1">Jeda Teks Muncul (ms)</label>
                        <input type="number" wire:model="text_delay" class="w-full rounded-lg border-zinc-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Misal: 1000">
                        <p class="mt-1 text-xs text-zinc-500">Waktu tunggu teks sebelum meluncur masuk. Default: 1000 (1 detik).</p>
                        @error('text_delay') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-zinc-200 flex items-center justify-between">
                <button type="button" wire:click="resetToDefault" wire:confirm="Anda yakin ingin mereset semua pengaturan ini ke nilai awalnya?" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">
                    Kembalikan ke Default
                </button>
                <div class="flex gap-3">
                    <a href="{{ route('admin.hero.index') }}" class="px-5 py-2.5 bg-white border border-zinc-300 text-zinc-700 rounded-lg font-medium text-sm hover:bg-zinc-50 transition-colors">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-primary-600 border border-transparent text-white rounded-lg font-medium text-sm hover:bg-primary-700 transition-colors shadow-sm">
                        Simpan Pengaturan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
