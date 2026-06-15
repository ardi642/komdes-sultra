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

        <form x-data="galleryManager(@js($existing_photos))" @submit.prevent="submitForm" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
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
                        <x-rich-text-editor wire:model="description" />
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
                    <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Custom (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-3">Jika tidak diisi, halaman publik otomatis menampilkan foto urutan pertama dari daftar galeri sebagai sampul.</p>
                        
                        <div class="flex items-start gap-6">
                            @if ($thumbnail)
                                <div class="w-32 h-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm shrink-0 relative">
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-full h-full object-cover">
                                </div>
                            @elseif ($existing_thumbnail)
                                <div class="group w-32 h-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm shrink-0 relative">
                                    <img src="{{ asset($existing_thumbnail) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button type="button" wire:click="removeThumbnail" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transform hover:scale-110 transition shadow-lg" title="Hapus Thumbnail">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="w-32 h-32 rounded-lg bg-gray-50 border border-dashed border-gray-300 flex items-center justify-center shrink-0">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            <div class="flex-1">
                                <label class="block w-full cursor-pointer bg-white border border-gray-300 rounded-lg p-3 hover:bg-gray-50 transition text-center border-dashed">
                                    <span class="text-sm text-gray-600 font-medium">Klik untuk pilih thumbnail</span>
                                    <input type="file" wire:model="thumbnail" class="hidden" accept="image/*" onchange="if(this.files[0] && this.files[0].size > 5 * 1024 * 1024) { alert('Ukuran file melebihi batas maksimal 5MB.'); this.value = ''; return false; }">
                                </label>
                                <div wire:loading wire:target="thumbnail" class="text-sm text-green-600 mt-2 font-medium">Mengunggah thumbnail...</div>
                                @error('thumbnail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Multiple Photos Dropzone (Alpine + SortableJS) -->
                    <div class="pt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Daftar Foto-foto Galeri</label>
                        <p class="text-xs text-gray-500 mb-3">Pilih banyak foto sekaligus. Anda bisa menyeret (drag) foto untuk mengubah urutannya.</p>

                        <!-- Upload Area -->
                        <div class="relative group" 
                             @dragover.prevent="$el.classList.add('border-green-400', 'bg-green-50')"
                             @dragleave.prevent="$el.classList.remove('border-green-400', 'bg-green-50')"
                             @drop.prevent="$el.classList.remove('border-green-400', 'bg-green-50'); handleDrop($event)">
                            
                            <label class="block w-full cursor-pointer bg-gray-50 border-2 border-gray-300 border-dashed rounded-xl p-8 hover:bg-gray-100 hover:border-green-400 transition-colors text-center">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-3 group-hover:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <span class="text-sm text-gray-600 font-medium block mb-1">Tarik & Lepas file foto di sini, atau Klik untuk mencari file</span>
                                <span class="text-xs text-gray-400">Mendukung format JPG, PNG, WEBP</span>
                                <input type="file" @change="handleFileSelect" x-ref="fileInput" multiple class="hidden" accept="image/*">
                            </label>
                            
                            <!-- Loading Indicator -->
                            <div x-show="isUploading" style="display: none;" class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-xl flex items-center justify-center border-2 border-green-500 border-dashed z-10">
                                <div class="flex flex-col items-center">
                                    <svg class="animate-spin h-8 w-8 text-green-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span class="text-sm font-semibold text-green-700">Mengunggah file...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Grid (Sortable) -->
                        <div class="mt-6" x-show="images.length > 0" style="display: none;">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Daftar Foto (Tarik untuk ubah urutan)</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" x-ref="sortableList">
                                
                                <template x-for="(image, index) in images" :key="image.id">
                                    <div class="relative group rounded-lg overflow-hidden border-2 cursor-move aspect-w-1 aspect-h-1 shadow-sm transition-all duration-200"
                                         :class="{'border-red-400': image.is_deleted, 'border-green-200': image.is_new && !image.is_deleted, 'border-gray-200': !image.is_new && !image.is_deleted}">
                                        
                                        <!-- Add a direct image tag, handling paths correctly -->
                                        <img :src="image.image_path.startsWith('/') || image.image_path.startsWith('http') ? image.image_path : '/' + image.image_path" class="w-full h-full object-cover transition-all duration-200" :class="{'grayscale opacity-40': image.is_deleted}">
                                        
                                        <!-- Normal Hover Overlay (Only if not deleted) -->
                                        <div x-show="!image.is_deleted" class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                            <button @click.prevent="removeImage(index)" type="button" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transform hover:scale-110 transition shadow-lg" title="Hapus Gambar">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Deleted State Overlay (Always visible when deleted) -->
                                        <div x-show="image.is_deleted" style="display: none;" class="absolute inset-0 flex flex-col items-center justify-center bg-red-50/80 backdrop-blur-[2px] z-0">
                                            <!-- Trash Icon + Text -->
                                            <div class="flex flex-col items-center gap-1 mb-2 pointer-events-none text-red-600">
                                                <svg class="w-8 h-8 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                <span class="text-[11px] font-bold tracking-wider uppercase">Akan Dihapus</span>
                                            </div>
                                            
                                            <!-- Restore Button -->
                                            <button @click.prevent="restoreImage(index)" type="button" class="px-4 py-1.5 bg-white border border-red-200 text-red-600 text-xs font-medium rounded-lg hover:bg-red-50 hover:border-red-300 transition shadow-sm flex items-center gap-1.5" title="Batal Hapus">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                                Batal Hapus
                                            </button>
                                        </div>

                                        <!-- Permanent Remove (X) Button when deleted -->
                                        <button x-show="image.is_deleted" style="display: none;" @click.prevent="images.splice(index, 1)" type="button" class="absolute top-2 right-2 p-1.5 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition shadow-sm z-10" title="Buang dari tampilan">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                        <div x-show="image.is_new && !image.is_deleted" class="absolute top-1 left-1 bg-green-600/90 text-white text-[10px] px-2 py-0.5 rounded font-medium shadow">Baru</div>
                                        <div x-show="!image.is_new && !image.is_deleted" class="absolute top-1 left-1 bg-gray-800/80 text-white text-[10px] px-2 py-0.5 rounded shadow">Tersimpan</div>
                                        <div x-show="index === 0 && !image.is_deleted" class="absolute top-1 right-1 bg-blue-600/90 text-white text-[10px] px-2 py-0.5 rounded font-medium shadow flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                            Utama
                                        </div>
                                    </div>
                                </template>
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.gallery.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium text-sm transition">Batal</a>
                <button type="submit" :disabled="isUploading" class="px-5 py-2 border border-transparent rounded-lg text-white bg-green-600 hover:bg-green-700 font-medium text-sm transition shadow-sm flex items-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="save">{{ $galleryId ? 'Perbarui Galeri' : 'Simpan Galeri' }}</span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        {{ $galleryId ? 'Memperbarui...' : 'Menyimpan...' }}
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Script AlpineJS Gallery Manager -->
    @push('scripts')
    <script>
        function galleryManager(initialImages) {
            return {
                images: initialImages || [],
                deletedImages: [],
                isUploading: false,
                
                init() {
                    // Beri penanda untuk foto lama
                    this.images = (this.images || []).map(img => {
                        return { ...img, is_new: false, is_deleted: false };
                    });
                    
                    this.$nextTick(() => {
                        this.initSortable();
                    });
                },
                
                initSortable() {
                    let el = this.$refs.sortableList;
                    if(!el || typeof window.Sortable === 'undefined') return;
                    
                    window.Sortable.create(el, {
                        animation: 150,
                        ghostClass: 'opacity-50',
                        onEnd: (evt) => {
                            // Pindahkan elemen di dalam array Alpine agar state sinkron dengan visual
                            const itemEl = this.images[evt.oldIndex];
                            this.images.splice(evt.oldIndex, 1);
                            this.images.splice(evt.newIndex, 0, itemEl);
                        }
                    });
                },
                
                handleDrop(e) {
                    let files = e.dataTransfer.files;
                    this.uploadFiles(files);
                },
                
                handleFileSelect(e) {
                    let files = e.target.files;
                    this.uploadFiles(files);
                },
                
                uploadFiles(files) {
                    if (files.length === 0) return;

                    let validFiles = [];
                    for(let i=0; i<files.length; i++) {
                        if (files[i].size > 5 * 1024 * 1024) {
                            alert('Gagal: Ukuran file ' + files[i].name + ' melebihi batas maksimal 5MB.');
                        } else {
                            validFiles.push(files[i]);
                        }
                    }

                    if(validFiles.length === 0) {
                        if (this.$refs.fileInput) {
                            this.$refs.fileInput.value = '';
                        }
                        return;
                    }

                    this.isUploading = true;
                    
                    let uploadPromises = validFiles.map(file => {
                        let formData = new FormData();
                        formData.append('file', file);
                        
                        return fetch('{{ route("admin.upload.gallery.image") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.id) {
                                this.images.push({
                                    id: data.id,
                                    image_path: data.url,
                                    is_new: true,
                                    is_deleted: false
                                });
                            } else if (data.error) {
                                throw new Error(data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Error uploading:', error);
                            alert('Gagal mengunggah gambar: ' + file.name + '\nPastikan ukuran maksimal 5MB.');
                        });
                    });

                    Promise.all(uploadPromises).finally(() => {
                        this.isUploading = false;
                        if (this.$refs.fileInput) {
                            this.$refs.fileInput.value = ''; // Reset input file
                        }
                    });
                },
                
                removeImage(index) {
                    let img = this.images[index];
                    if (!img.is_new && !this.deletedImages.includes(img.id)) {
                        this.deletedImages.push(img.id);
                    }
                    img.is_deleted = true;
                },
                
                restoreImage(index) {
                    let img = this.images[index];
                    img.is_deleted = false;
                    this.deletedImages = this.deletedImages.filter(id => id !== img.id);
                },
                
                async submitForm() {
                    // Ambil ID yang valid (tidak dihapus)
                    let finalIds = this.images
                        .filter(img => !img.is_deleted)
                        .map(img => img.id);
                        
                    await this.$wire.set('galleryImages', finalIds);
                    await this.$wire.set('deletedImages', this.deletedImages);
                    
                    this.$wire.save();
                }
            }
        }
    </script>
    @endpush
</div>
