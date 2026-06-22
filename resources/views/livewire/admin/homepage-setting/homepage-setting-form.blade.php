<div>

    @if (session()->has('message'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-xl" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">
        
        <!-- Tentang Komdes Sultra -->
        <div class="p-6 bg-white border border-zinc-200 rounded-2xl shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-zinc-800">Bagian: Tentang Komdes Sultra</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Deskripsi Utama</label>
                    <textarea wire:model="about_description" rows="5" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Masukkan deskripsi tentang Komdes Sultra..."></textarea>
                    @error('about_description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Tipe Media Pendamping</label>
                    <select wire:model.live="about_media_type" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        <option value="none">Tidak Ada (Teks Melebar Penuh)</option>
                        <option value="image">Gambar/Foto</option>
                        <option value="youtube">Video YouTube</option>
                    </select>
                    @error('about_media_type') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                @if($about_media_type === 'image')
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Upload Gambar</label>
                    @if ($about_image_path && !$new_about_image)
                        <div class="mb-2">
                            <img src="{{ asset($about_image_path) }}" alt="Current Image" class="h-32 rounded-lg object-cover">
                        </div>
                    @endif
                    @if ($new_about_image)
                        <div class="mb-2">
                            <img src="{{ $new_about_image->temporaryUrl() }}" alt="New Image Preview" class="h-32 rounded-lg object-cover">
                        </div>
                    @endif
                    <input type="file" wire:model="new_about_image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    @error('new_about_image') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                @endif

                @if($about_media_type === 'youtube')
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Link / Embed YouTube</label>
                    <p class="mb-2 text-xs text-zinc-500">Anda dapat memasukkan Link Video biasa atau menempelkan langsung kode &lt;iframe&gt; yang didapat dari menu Share > Embed YouTube.</p>
                    <textarea wire:model="about_youtube_url" rows="3" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="https://www.youtube.com/watch?v=... atau <iframe src=..."></textarea>
                    @error('about_youtube_url') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Tombol 1 -->
                    <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200">
                        <h4 class="mb-3 text-sm font-semibold text-zinc-700">Tombol Aksi 1</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-zinc-600">Teks Tombol</label>
                                <input type="text" wire:model="about_btn1_text" class="w-full px-3 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-lg focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Misal: Tentang Kami (Kosongkan jika tidak ingin ditampilkan)">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-zinc-600">Link / URL Tombol</label>
                                <input type="text" wire:model="about_btn1_url" class="w-full px-3 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-lg focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Misal: /tentang-kami">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol 2 -->
                    <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200">
                        <h4 class="mb-3 text-sm font-semibold text-zinc-700">Tombol Aksi 2</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-zinc-600">Teks Tombol</label>
                                <input type="text" wire:model="about_btn2_text" class="w-full px-3 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-lg focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Misal: Hubungi Kami (Kosongkan jika tidak ingin ditampilkan)">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-zinc-600">Link / URL Tombol</label>
                                <input type="text" wire:model="about_btn2_url" class="w-full px-3 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-lg focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Misal: /kontak">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teks Sub-judul Section -->
        <div class="p-6 bg-white border border-zinc-200 rounded-2xl shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-zinc-800">Teks Pengantar (Sub-judul) Bagian Lain</h3>
            <p class="mb-6 text-sm text-zinc-500">Atur kalimat pengantar yang muncul di bawah judul setiap bagian di beranda.</p>
            
            <div class="space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Anggota Jejaring</label>
                    <input type="text" wire:model="network_subtitle" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Jejaring komunitas dan organisasi lokal...">
                    @error('network_subtitle') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Fokus Isu</label>
                    <input type="text" wire:model="issue_subtitle" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Isu strategis yang menjadi fokus...">
                    @error('issue_subtitle') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Agenda Acara</label>
                    <input type="text" wire:model="agenda_subtitle" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Ikuti berbagai kegiatan edukasi...">
                    @error('agenda_subtitle') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Pusat Publikasi</label>
                    <input type="text" wire:model="publication_subtitle" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Kabar terbaru, artikel opini...">
                    @error('publication_subtitle') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-700">Galeri Kegiatan</label>
                    <input type="text" wire:model="gallery_subtitle" class="w-full px-4 py-2 text-sm bg-zinc-100 border-zinc-200 rounded-xl focus:bg-white focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Dokumentasi aksi lapangan...">
                    @error('gallery_subtitle') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 border-t border-gray-100 pt-6 mt-8">
            <button type="button" @click="$dispatch('open-confirm-modal', {
                title: 'Batalkan Perubahan?',
                message: 'Semua perubahan yang belum disimpan akan hilang dan formulir akan dikembalikan ke data terakhir.',
                confirmText: 'Ya, Batal',
                onConfirm: () => window.location.reload()
            })" class="px-5 py-2 bg-white text-zinc-700 font-semibold rounded-lg shadow-sm border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-900 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Batal
            </button>

            <button type="submit" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>

    @script
    <script>
        $wire.on('scroll-to-top', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    @endscript
</div>
