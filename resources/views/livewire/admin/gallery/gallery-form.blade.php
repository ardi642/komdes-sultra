<div>
    <div class="space-y-6 max-w-5xl mx-auto">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $galleryId ? 'Edit Galeri Kegiatan' : 'Tambah Galeri Kegiatan' }}</h1>
                <p class="text-gray-600 text-sm mt-1">Lengkapi form di bawah ini untuk menyimpan data galeri.</p>
            </div>
            <a href="{{ route('admin.gallery.index') }}" class="text-gray-600 hover:text-gray-900 transition flex items-center gap-1 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <form wire:submit="save" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 md:p-8 space-y-8">
                
                <!-- Informasi Utama -->
                <div class="space-y-6">
                    <h2 class="text-lg font-bold text-gray-900 border-b pb-2">Informasi Utama</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Galeri <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="title" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Contoh: Penanaman Mangrove 2026">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                            <input type="date" wire:model="date" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @error('date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kegiatan (Opsional)</label>
                        <textarea wire:model="description" rows="4" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder="Ceritakan sedikit tentang kegiatan ini..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL / Embed Video Youtube (Opsional)</label>
                        <input type="text" wire:model="video_url" class="bg-gray-100 focus:bg-white transition-colors w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" placeholder='https://www.youtube.com/watch?v=... atau kode <iframe...'>
                        <p class="text-xs text-gray-500 mt-1">Anda dapat memasukkan Link Video biasa atau menempelkan langsung kode <code class="bg-gray-100 px-1 rounded">&lt;iframe&gt;</code> yang didapat dari menu <b>Share &gt; Embed</b> YouTube.</p>
                        @error('video_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Media -->
                <div class="space-y-6">
                    <h2 class="text-lg font-bold text-gray-900 border-b pb-2">Media Galeri</h2>

                    <!-- Thumbnail Utama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Utama (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-3">Jika tidak diisi, sistem akan otomatis mengambil foto pertama sebagai thumbnail.</p>
                        
                        <div class="flex items-start gap-6">
                            @if ($thumbnail)
                                <div class="w-32 h-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm shrink-0 relative">
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-full h-full object-cover">
                                </div>
                            @elseif ($existing_thumbnail)
                                <div class="w-32 h-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm shrink-0 relative">
                                    <img src="{{ asset($existing_thumbnail) }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-32 h-32 rounded-lg bg-gray-50 border border-dashed border-gray-300 flex items-center justify-center shrink-0">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            <div class="flex-1">
                                <label class="block w-full cursor-pointer bg-white border border-gray-300 rounded-lg p-3 hover:bg-gray-50 transition text-center border-dashed">
                                    <span class="text-sm text-gray-600 font-medium">Klik untuk pilih thumbnail</span>
                                    <input type="file" wire:model="thumbnail" class="hidden" accept="image/*">
                                </label>
                                <div wire:loading wire:target="thumbnail" class="text-sm text-green-600 mt-2 font-medium">Mengunggah thumbnail...</div>
                                @error('thumbnail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Multiple Photos Dropzone (FilePond Like) -->
                    <div class="pt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Daftar Foto-foto Galeri</label>
                        <p class="text-xs text-gray-500 mb-3">Pilih banyak foto sekaligus. Rekomendasi ukuran maksimal 2MB per foto.</p>

                        <!-- Upload Area -->
                        <div class="relative group">
                            <label class="block w-full cursor-pointer bg-gray-50 border-2 border-gray-300 border-dashed rounded-xl p-8 hover:bg-gray-100 hover:border-green-400 transition-colors text-center">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-3 group-hover:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <span class="text-sm text-gray-600 font-medium block mb-1">Tarik & Lepas file foto di sini, atau Klik untuk mencari file</span>
                                <span class="text-xs text-gray-400">Mendukung format JPG, PNG, WEBP</span>
                                <input type="file" wire:model="photos" multiple class="hidden" accept="image/*">
                            </label>
                            
                            <!-- Loading Indicator -->
                            <div wire:loading wire:target="photos" class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-xl flex items-center justify-center border-2 border-green-500 border-dashed z-10">
                                <div class="flex flex-col items-center">
                                    <svg class="animate-spin h-8 w-8 text-green-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span class="text-sm font-semibold text-green-700">Mengunggah file...</span>
                                </div>
                            </div>
                        </div>
                        @error('photos.*') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                        <!-- Preview Grid -->
                        @if(count($existing_photos) > 0 || count($photos) > 0)
                        <div class="mt-6">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Foto Tersimpan & Antrean Unggahan</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                
                                <!-- Existing Photos -->
                                @foreach($existing_photos as $index => $photo)
                                <div class="relative group rounded-lg overflow-hidden border border-gray-200 aspect-w-1 aspect-h-1 bg-gray-100">
                                    <img src="{{ asset($photo['image_path']) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button type="button" wire:click="removeExistingPhoto({{ $photo['id'] }})" onclick="confirm('Hapus foto ini secara permanen?') || event.stopImmediatePropagation()" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transform hover:scale-110 transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    <div class="absolute top-1 left-1 bg-gray-800/80 text-white text-[10px] px-2 py-0.5 rounded">Tersimpan</div>
                                </div>
                                @endforeach

                                <!-- New Photos (Preview) -->
                                @foreach($photos as $index => $photo)
                                <div class="relative group rounded-lg overflow-hidden border-2 border-green-200 aspect-w-1 aspect-h-1 bg-green-50 shadow-sm">
                                    <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button type="button" wire:click="removeNewPhoto({{ $index }})" class="p-2 bg-white text-gray-800 rounded-full hover:bg-red-50 hover:text-red-600 transform hover:scale-110 transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    <div class="absolute top-1 left-1 bg-green-600/90 text-white text-[10px] px-2 py-0.5 rounded font-medium">Baru</div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.gallery.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium text-sm transition">Batal</a>
                <button type="submit" class="px-5 py-2 border border-transparent rounded-lg text-white bg-green-600 hover:bg-green-700 font-medium text-sm transition shadow-sm flex items-center">
                    <span wire:loading.remove wire:target="save">Simpan Galeri</span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
