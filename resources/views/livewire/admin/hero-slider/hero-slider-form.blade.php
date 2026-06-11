<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-zinc-900">{{ $sliderId ? 'Edit' : 'Tambah' }} Slider Beranda</h1>
        <a href="{{ route('admin.hero.index') }}" class="text-zinc-500 hover:text-zinc-700 font-medium text-sm transition-colors">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <form wire:submit.prevent="save" class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Image Upload -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Foto Latar (Background) <span class="text-red-500">*</span></label>
                    <p class="text-xs text-zinc-500 mb-4">Gunakan gambar landscape resolusi tinggi (misal: 1920x1080) untuk hasil maksimal.</p>
                    
                    <div class="border-2 border-dashed border-zinc-300 rounded-xl p-4 text-center hover:bg-zinc-50 transition-colors relative">
                        <input type="file" wire:model="image_path" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        
                        @if ($image_path)
                            <img src="{{ $image_path->temporaryUrl() }}" class="max-h-48 mx-auto rounded-lg shadow-sm">
                            <div class="mt-2 text-sm text-primary-600 font-medium">Ganti Gambar</div>
                        @elseif($old_image)
                            <img src="{{ asset($old_image) }}" class="max-h-48 mx-auto rounded-lg shadow-sm">
                            <div class="mt-2 text-sm text-primary-600 font-medium">Ganti Gambar</div>
                        @else
                            <div class="py-8">
                                <svg class="w-12 h-12 text-zinc-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium text-zinc-600">Klik atau drop gambar ke sini</span>
                            </div>
                        @endif
                    </div>
                    <div wire:loading wire:target="image_path" class="text-sm text-blue-600 mt-2">Mengunggah gambar...</div>
                    @error('image_path') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Right: Content Fields -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-1">Judul Utama (Opsional)</label>
                        <input type="text" wire:model="title" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Contoh: Menjaga Ekosistem Pesisir">
                        @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-1">Sub Judul / Deskripsi (Opsional)</label>
                        <textarea wire:model="subtitle" rows="3" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Penjelasan singkat..."></textarea>
                        @error('subtitle') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-zinc-100 pt-6">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-1">Teks Tombol 1 (Opsional)</label>
                            <input type="text" wire:model="btn1_text" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Contoh: Tentang Kami">
                            @error('btn1_text') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-1">Link Tombol 1</label>
                            <input type="text" wire:model="btn1_url" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="/tentang-kami">
                            @error('btn1_url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-1">Teks Tombol 2 (Opsional)</label>
                            <input type="text" wire:model="btn2_text" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="Contoh: Hubungi Kami">
                            @error('btn2_text') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-1">Link Tombol 2</label>
                            <input type="text" wire:model="btn2_url" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" placeholder="/kontak">
                            @error('btn2_url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="w-1/3 pt-4 border-t border-zinc-100">
                        <label class="block text-sm font-semibold text-zinc-700 mb-1">Nomor Urut</label>
                        <input type="number" wire:model="order_number" class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('order_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-4 border-t border-zinc-100 pt-6">
                <a href="{{ route('admin.hero.index') }}" class="text-zinc-600 hover:text-zinc-900 font-medium text-sm transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-xl font-medium text-sm transition-all shadow-lg hover:shadow-primary-500/30">
                    Simpan Slider
                </button>
            </div>
        </form>
    </div>
</div>
