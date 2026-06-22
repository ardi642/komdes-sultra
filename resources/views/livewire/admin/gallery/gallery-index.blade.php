<div>
    <div class="space-y-6" x-data="{ selectionMode: false }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Galeri Kegiatan</h1>
                <p class="text-gray-600 text-sm mt-1">Kelola galeri foto dan video kegiatan.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <button @click="selectionMode = !selectionMode; if(!selectionMode) { $wire.cancelBatchDelete() }" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition shadow-sm" :class="{'bg-green-50 border-green-300 text-green-700': selectionMode}">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span x-text="selectionMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
                </button>
                <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Galeri
                </a>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Top Action Bar (Search & Filters) -->
            <div x-data="{ showFilters: false }" class="bg-white p-4 border-b border-gray-200 bg-gray-50 mb-0">
                
                <!-- Main Bar: Search, Per Page, Toggle -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    
                    <!-- Left: Search -->
                    <div class="w-full sm:max-w-xs relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul galeri..." class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
                    </div>

                    <!-- Right: Per Page & Filter Toggle -->
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-600 hidden sm:inline">Tampil:</span>
                            <select wire:model.live="perPage" class="bg-gray-100 focus:bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-2 pl-3 pr-8 text-gray-900 transition-colors">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        
                        <button @click="showFilters = !showFilters" type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors shadow-sm gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter Lanjutan
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Expanded Filters Drawer -->
                <div x-show="showFilters" x-collapse>
                    <div class="pt-4 mt-4 border-t border-gray-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Waktu (Bulan / Tahun)</label>
                            <div class="flex gap-2">
                                <select wire:model.live="filterMonth" class="w-1/2 bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-2 px-3 text-gray-900">
                                    <option value="">Bulan</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                    @endfor
                                </select>
                                <select wire:model.live="filterYear" class="w-1/2 bg-white text-sm border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-2 px-3 text-gray-900">
                                    <option value="">Tahun</option>
                                    @for($i=date('Y'); $i>=2020; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Pembuat</label>
                            <x-tom-select wire:model.live="filterAuthor" :multiple="false" placeholder="Semua Pembuat" class="w-full bg-white text-sm border-gray-300 rounded-lg">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </x-tom-select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="p-4 w-4" x-show="selectionMode" x-transition>
                                <div class="flex items-center">
                                    <input type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium w-16">Thumbnail</th>
                            <th scope="col" class="px-6 py-4 font-medium">Judul Galeri</th>
                            <th scope="col" class="px-6 py-4 font-medium">Pembuat</th>
                            <th scope="col" class="px-6 py-4 font-medium">Dibuat Pada</th>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal Kegiatan</th>
                            <th scope="col" class="px-6 py-4 font-medium">Jumlah Foto</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($galleries as $item)
                            <tr class="hover:bg-gray-50 transition-colors {{ in_array($item->id, $selectedItems) ? 'bg-green-50/50' : '' }}">
                                <td class="p-4 w-4" x-show="selectionMode" x-transition>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model.live="selectedItems" value="{{ $item->id }}" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                        @if($item->thumbnail)
                                            <img src="{{ asset($item->thumbnail) }}" class="w-full h-full object-cover">
                                        @elseif($item->images->count() > 0)
                                            <img src="{{ asset($item->images->first()->image_path) }}" class="w-full h-full object-cover">
                                        @elseif($item->video_url)
                                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                                    @if($item->video_url)
                                    <div class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        Ada Video
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-medium">
                                    {{ $item->user?->name ?? 'Sistem' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                    {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->images->count() }} Foto
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ url('/galeri/' . $item->slug) }}" target="_blank" class="text-green-600 hover:text-green-900 mx-2">
                                        Lihat
                                    </a>
                                    @if(!auth()->user()->hasRole('Mitra Media') || $item->user_id === auth()->id())
                                        <a href="{{ route('admin.gallery.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mx-2">
                                            Edit
                                        </a>
                                        <button @click="$dispatch('open-confirm-modal', {
                                                title: 'Konfirmasi Penghapusan',
                                                message: 'Data galeri akan dihapus secara permanen. File foto terkait akan dialihkan ke menu <b>Tempat Sampah</b> dan dibersihkan secara otomatis oleh sistem dalam waktu 1x24 jam. Pembersihan manual juga dapat dilakukan sewaktu-waktu melalui menu tersebut. Lanjutkan proses penghapusan?',
                                                confirmText: 'Ya, Hapus Galeri',
                                                onConfirm: () => $wire.delete({{ $item->id }})
                                            })" 
                                            class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data galeri kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($galleries->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $galleries->links() }}
            </div>
            @endif
        </div>

        <!-- Floating Action Bar for Bulk Actions -->
        @if(count($selectedItems) > 0)
        <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40 bg-zinc-900 rounded-full shadow-2xl border border-zinc-700 p-2 pl-4 pr-2 flex justify-between items-center transition-all duration-300">
            <div class="text-sm font-medium text-white flex items-center gap-3 mr-6">
                <span class="bg-green-500 text-white py-0.5 px-2 rounded-md font-bold">{{ count($selectedItems) }}</span> item
            </div>
            <div class="flex items-center gap-2">
                <button @click="$dispatch('open-confirm-modal', {
                        title: 'Konfirmasi Penghapusan Massal',
                        message: 'Anda akan menghapus {{ count($selectedItems) }} data galeri secara permanen. File foto terkait akan dialihkan ke Tempat Sampah. Lanjutkan?',
                        confirmText: 'Ya, Hapus Semua',
                        onConfirm: () => $wire.bulkDelete()
                    })" 
                    class="inline-flex items-center justify-center p-2 bg-red-600 hover:bg-red-500 text-white rounded-full transition shadow-sm" title="Hapus Terpilih">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <div class="h-6 w-px bg-zinc-700 mx-1"></div>
                <button @click="selectionMode = false; $wire.cancelBatchDelete()" class="inline-flex items-center justify-center p-2 hover:bg-zinc-800 text-zinc-400 hover:text-white rounded-full transition" title="Batal">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        @endif
        
        <!-- Deletion Progress Modal -->
        <div x-data="{
                isDeleting: @entangle('isDeleting'),
                total: @entangle('deleteTotal'),
                processed: @entangle('deleteProcessed'),
                success: @entangle('deleteSuccess'),
                failed: @entangle('deleteFailed'),
                get progressPercentage() {
                    if (this.total === 0) return 0;
                    return Math.round((this.processed / this.total) * 100);
                }
            }"
            x-show="isDeleting"
            @batch-delete-started.window="$wire.processNextChunk()"
            @chunk-processed.window="$wire.processNextChunk()"
            @batch-delete-finished.window="
                setTimeout(() => {
                    let msg = 'Berhasil menghapus ' + $event.detail.success + ' item.';
                    if ($event.detail.failed > 0) {
                        msg += ' Gagal: ' + $event.detail.failed;
                    }
                    alert(msg);
                    selectionMode = false;
                }, 500);
            "
            x-cloak
            class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-zinc-900/75 backdrop-blur-sm transition-opacity"></div>
            <div class="relative bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl transform transition-all text-center">
                <div class="mb-6">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto"></div>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 mb-2">Menghapus Data...</h3>
                <p class="text-sm text-zinc-500 mb-6">Mohon jangan tutup jendela ini hingga proses selesai.</p>
                
                <div class="w-full bg-zinc-100 rounded-full h-3 mb-2 overflow-hidden">
                    <div class="bg-primary-600 h-3 rounded-full transition-all duration-300" :style="`width: ${progressPercentage}%`"></div>
                </div>
                <div class="flex justify-between text-xs font-medium text-zinc-500">
                    <span x-text="`${progressPercentage}%`">0%</span>
                    <span x-text="`${processed} dari ${total}`">0 dari 0</span>
                </div>
                <div class="mt-6">
                    <button type="button" wire:click="cancelBatchDelete" class="text-sm text-red-600 hover:text-red-800 font-medium px-4 py-2 hover:bg-red-50 rounded-lg transition-colors">
                        Batalkan Sisa Proses
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
