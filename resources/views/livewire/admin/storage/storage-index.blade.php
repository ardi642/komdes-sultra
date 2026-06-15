<div>
    <div class="space-y-6 relative">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Tempat Sampah Gambar</h1>
                <p class="text-sm text-zinc-500 mt-1">Kelola file gambar "sampah" sisa dari editor teks dan galeri yang sudah tidak terpakai.</p>
            </div>
            <button @click="$dispatch('open-confirm-modal', {
                    title: 'Kosongkan Tempat Sampah',
                    message: 'Ruang penyimpanan akan dibebaskan. Lanjutkan pembersihan sekarang?',
                    confirmText: 'Ya, Bersihkan',
                    onConfirm: () => $wire.initEmptyAll()
                })" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 transition ease-in-out duration-150 shadow-sm gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Kosongkan Tempat Sampah
            </button>
        </div>

        <!-- Custom Flash Message for Deletion Summary -->
        <div id="delete-summary-alert" class="hidden bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
            <p id="delete-summary-text"></p>
        </div>

        <!-- Tabs -->
        <div class="border-b border-zinc-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button wire:click="$set('activeTab', 'gallery')" class="{{ $activeTab === 'gallery' ? 'border-primary-500 text-primary-600' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Sampah Galeri ({{ \App\Models\GalleryImage::whereNull('gallery_id')->count() }})
                </button>
                <button wire:click="$set('activeTab', 'editor')" class="{{ $activeTab === 'editor' ? 'border-primary-500 text-primary-600' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Sampah Editor ({{ \App\Models\EditorImage::whereNull('imageable_id')->count() }})
                </button>
            </nav>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
            <!-- Toolbar -->
            <div class="flex items-center justify-between p-4 border-b border-zinc-200 bg-zinc-50">
                <div class="flex items-center gap-4">
                    @if($activeTab === 'gallery' ? count($selectedGalleryImages) > 0 : count($selectedEditorImages) > 0)
                        <span class="text-sm font-medium text-zinc-700">
                            {{ $activeTab === 'gallery' ? count($selectedGalleryImages) : count($selectedEditorImages) }} item terpilih
                        </span>
                        <button @click="$dispatch('open-confirm-modal', {
                                title: 'Hapus File Terpilih',
                                message: 'File yang dipilih akan dihapus untuk menghemat ruang penyimpanan. Lanjutkan?',
                                confirmText: 'Ya, Bersihkan',
                                onConfirm: () => $wire.initDeleteSelected()
                            })" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-md text-xs font-semibold transition-colors">
                            Hapus Terpilih
                        </button>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-zinc-600">Tampil:</span>
                    <select wire:model.live="perPage" class="bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-1.5 pl-3 pr-8 text-zinc-900 transition-colors">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-zinc-600">
                    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium w-12">
                                @if($activeTab === 'gallery')
                                    <input type="checkbox" wire:model.live="selectAllGallery" class="w-5 h-5 cursor-pointer rounded border-zinc-300 text-primary-600 shadow-sm focus:ring-primary-500">
                                @else
                                    <input type="checkbox" wire:model.live="selectAllEditor" class="w-5 h-5 cursor-pointer rounded border-zinc-300 text-primary-600 shadow-sm focus:ring-primary-500">
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium w-20">File</th>
                            <th scope="col" class="px-6 py-3 font-medium min-w-[200px]">Path Lokasi</th>
                            <th scope="col" class="px-6 py-3 font-medium">Usia Sampah</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Perkiraan Dihapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200">
                        @php
                            $items = $activeTab === 'gallery' ? $galleryTrash : $editorTrash;
                            $selectedArray = $activeTab === 'gallery' ? $selectedGalleryImages : $selectedEditorImages;
                        @endphp
                        
                        @forelse($items as $item)
                        <tr x-data @click="if(!['INPUT', 'A', 'IMG'].includes($event.target.tagName)) { $refs.checkbox.click() }" class="hover:bg-zinc-50 cursor-pointer transition-colors {{ in_array($item->id, $selectedArray) ? 'bg-primary-50' : '' }}">
                            <td class="px-6 py-4">
                                @if($activeTab === 'gallery')
                                    <input x-ref="checkbox" type="checkbox" wire:model.live="selectedGalleryImages" value="{{ $item->id }}" class="w-5 h-5 cursor-pointer rounded border-zinc-300 text-primary-600 shadow-sm focus:ring-primary-500">
                                @else
                                    <input x-ref="checkbox" type="checkbox" wire:model.live="selectedEditorImages" value="{{ $item->id }}" class="w-5 h-5 cursor-pointer rounded border-zinc-300 text-primary-600 shadow-sm focus:ring-primary-500">
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ asset($item->image_path) }}" target="_blank">
                                    <img src="{{ asset($item->image_path) }}" alt="img" class="w-10 h-10 object-cover rounded shadow-sm border border-zinc-200 hover:opacity-80 transition-opacity">
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-mono text-xs text-zinc-500 break-all bg-zinc-100 p-1.5 rounded">{{ $item->image_path }}</div>
                            </td>
                            <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                                {{ $item->updated_at->locale('id')->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                @php
                                    $deadline = $item->updated_at->addHours(24);
                                    $isExpired = now()->greaterThanOrEqualTo($deadline);
                                @endphp
                                @if($isExpired)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Masuk Antrean Hapus
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $deadline->locale('id')->diffForHumans(['parts' => 2, 'join' => ' ']) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                <h3 class="mt-2 text-sm font-semibold text-zinc-900">Tempat Sampah Bersih</h3>
                                <p class="mt-1 text-sm text-zinc-500">Tidak ada file sampah yang tersisa di tab ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $items->links() }}
                </div>
            @endif
        </div>

        <!-- AlpineJS & Livewire Orchestration for Cancelable Batch Delete -->
        <div x-data="{
                isDeleting: @entangle('isDeleting').live,
                total: @entangle('deleteTotal').live,
                processed: @entangle('deleteProcessed').live,
                success: @entangle('deleteSuccess').live,
                failed: @entangle('deleteFailed').live,
                percentage: 0,
                showModal: false,
                status: 'running' // 'running', 'finished', 'cancelled'
            }"
            x-init="
                $watch('isDeleting', value => {
                    if (value) {
                        showModal = true;
                        status = 'running';
                    }
                });
                $watch('processed', value => {
                    percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                });
            "
            @batch-delete-started.window="
                $wire.processNextChunk();
            "
            @chunk-processed.window="
                if(isDeleting) {
                    setTimeout(() => {
                        $wire.processNextChunk();
                    }, 50);
                }
            "
            @batch-delete-finished.window="
                status = 'finished';
            "
            @batch-delete-cancelled.window="
                status = 'cancelled';
            "
            x-show="showModal"
            style="display: none;"
            class="fixed inset-0 z-[110] flex items-center justify-center bg-zinc-900/60 backdrop-blur-sm"
            @click.self="if(status !== 'running') { showModal = false; $wire.$refresh(); }"
        >
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 text-center">
                
                <!-- STATE: RUNNING -->
                <div x-show="status === 'running'">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto mb-4"></div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Menghapus File...</h3>
                    <p class="text-sm text-zinc-500 mb-6">Sistem sedang membersihkan <span x-text="total" class="font-bold text-zinc-900"></span> file. Harap tunggu.</p>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-zinc-200 rounded-full h-2.5 mb-2 overflow-hidden">
                        <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300 ease-out" :style="'width: ' + Math.max(percentage, 5) + '%'"></div>
                    </div>
                    <div class="flex justify-between text-xs text-zinc-500 font-medium mb-6">
                        <span x-text="processed + ' diproses'"></span>
                        <span x-text="percentage + '%'"></span>
                    </div>

                    <button type="button" @click="$wire.cancelBatchDelete()" class="inline-flex justify-center w-full rounded-xl bg-red-100 px-4 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-200 focus:outline-none transition-colors">
                        Batalkan Proses
                    </button>
                </div>

                <!-- STATE: FINISHED -->
                <div x-show="status === 'finished'" style="display: none;">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Pembersihan Selesai</h3>
                    <p class="text-sm text-zinc-500 mb-6">Berhasil membebaskan ruang penyimpanan dengan menghapus <span x-text="success" class="font-bold text-zinc-900"></span> file sampah permanen.</p>
                    
                    <button type="button" @click="showModal = false; $wire.$refresh()" class="inline-flex justify-center w-full rounded-xl bg-zinc-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus:outline-none transition-colors">
                        Tutup & Selesai
                    </button>
                </div>

                <!-- STATE: CANCELLED -->
                <div x-show="status === 'cancelled'" style="display: none;">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                        <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Proses Dibatalkan</h3>
                    <p class="text-sm text-zinc-500 mb-6">Anda menghentikan proses pembersihan. Sistem sempat menghapus <span x-text="success" class="font-bold text-zinc-900"></span> file sebelum dihentikan.</p>
                    
                    <button type="button" @click="showModal = false; $wire.$refresh()" class="inline-flex justify-center w-full rounded-xl bg-zinc-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus:outline-none transition-colors">
                        Tutup & Selesai
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
