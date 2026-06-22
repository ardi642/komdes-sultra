<div class="space-y-6" x-data="{ selectionMode: false }">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-zinc-900">Manajemen Fokus Isu</h1>
        <div class="flex items-center gap-3">
            <button @click="selectionMode = !selectionMode; if(!selectionMode) { $wire.cancelBatchDelete() }" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-semibold text-xs text-zinc-700 uppercase tracking-widest hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition shadow-sm" :class="{'bg-primary-50 border-primary-300 text-primary-700': selectionMode}">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span x-text="selectionMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
            </button>
            <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Isu
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <p>{{ session('message') }}</p>
            </div>
            <button @click="show = false" type="button" class="text-green-600 hover:text-green-800 hover:bg-green-200 p-1.5 rounded-lg transition-colors ml-4 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Top Action Bar (Search & Filters) -->
    <div x-data="{ showFilters: false }" class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        
        <!-- Main Bar: Search, Per Page, Toggle -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
            
            <!-- Left: Search -->
            <div class="w-full sm:max-w-xs relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari isu..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
            </div>

            <!-- Right: Per Page & Filter Toggle -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-zinc-600 hidden sm:inline">Tampil:</span>
                    <select wire:model.live="perPage" class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 pl-3 pr-8 text-zinc-900 transition-colors">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                
                <button @click="showFilters = !showFilters" type="button" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-medium text-sm text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors shadow-sm gap-2">
                    <svg class="w-4 h-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter Lanjutan
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>

        <!-- Expanded Filters Drawer -->
        <div x-show="showFilters" x-collapse>
            <div class="p-4 bg-zinc-50 border-t border-zinc-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Status</label>
                    <select wire:model.live="filterStatus" class="w-full bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Pembuat</label>
                    <x-tom-select wire:model.live="filterAuthor" :multiple="false" placeholder="Semua Pembuat" class="w-full bg-white text-sm border-zinc-300 rounded-lg">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </x-tom-select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 uppercase tracking-wider mb-1.5">Waktu (Bulan / Tahun)</label>
                    <div class="flex gap-2">
                        <select wire:model.live="filterMonth" class="w-1/2 bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                            <option value="">Bulan</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                            @endfor
                        </select>
                        <select wire:model.live="filterYear" class="w-1/2 bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 px-3 text-zinc-900">
                            <option value="">Tahun</option>
                            @for($i=date('Y'); $i>=2020; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="overflow-x-auto relative">
                    <div wire:loading.flex wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-sm rounded-lg">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <table wire:loading.class="opacity-50 pointer-events-none" wire:target="search, perPage, gotoPage, nextPage, previousPage, filterType, filterStatus, filterCategory, filterAuthor, filterMonth, filterYear, filterTag" class="w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th scope="col" class="p-4 w-4" x-show="selectionMode" x-transition>
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer">
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium w-16">Cover</th>
                        <th scope="col" class="px-6 py-3 font-medium min-w-[200px]">Detail Isu</th>
                        <th scope="col" class="px-6 py-3 font-medium">Pembuat</th>
                        <th scope="col" class="px-6 py-3 font-medium">Dibuat Pada</th>
                        <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($issues as $issue)
                    <tr wire:key="issue-{{ $issue->id }}" class="hover:bg-zinc-50 transition-colors {{ in_array((string)$issue->id, $selectedItems) ? 'bg-primary-50/50' : '' }}">
                        <td class="p-4 w-4" x-show="selectionMode" x-transition>
                            <div class="flex items-center">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $issue->id }}" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($issue->cover_image)
                                <img src="{{ asset($issue->cover_image) }}" alt="{{ $issue->title }}" class="w-12 h-12 rounded object-cover border border-zinc-200">
                            @else
                                <div class="w-12 h-12 rounded bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-zinc-900">{{ $issue->title }}</div>
                            <div class="text-xs text-zinc-500 mt-1">{{ $issue->slug }}</div>
                        </td>
                        <td class="px-6 py-4 text-zinc-500 font-medium whitespace-nowrap">
                            {{ $issue->user?->name ?? 'Sistem' }}
                        </td>
                        <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">
                            {{ $issue->created_at ? $issue->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($issue->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ url('/isu/' . $issue->slug) }}" target="_blank" class="text-zinc-600 hover:text-zinc-900 font-medium mr-2" title="Lihat di Web">Web</a>
                            @if(!auth()->user()->hasRole('Mitra Media') || $issue->user_id === auth()->id())
                                <a href="{{ route('admin.issue.show', $issue->id) }}" class="text-primary-600 hover:text-primary-900 font-medium mr-2">Kelola Konten</a>
                                <button wire:click="edit({{ $issue->id }})" class="text-blue-600 hover:text-blue-900 font-medium mr-2">Edit</button>
                                <button type="button" @click="$dispatch('open-confirm-modal', { title: 'Konfirmasi Tindakan', message: 'Apakah Anda yakin ingin menghapus isu ini?', confirmText: 'Ya, Lanjutkan', onConfirm: () => @this.delete({{ $issue->id }}) })" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr wire:key="empty-row">
                        <td colspan="10" class="px-6 py-8 text-center text-zinc-500">Belum ada isu kampanye yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $issues->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="relative inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full z-50">
                <form wire:submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4 border-b border-zinc-100 pb-4">
                            <h3 class="text-lg leading-6 font-semibold text-zinc-900" id="modal-title">
                                {{ $issue_id ? 'Edit Isu Kampanye' : 'Tambah Isu Kampanye Baru' }}
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-4 md:col-span-2">
                                <div>
                                    <x-label for="title" value="Judul Isu" />
                                    <x-input id="title" type="text" wire:model.live="title" placeholder="Misal: Transparansi Anggaran Desa" />
                                    @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-label for="slug" value="Slug (Otomatis)" />
                                    <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-100" readonly />
                                    @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <x-label for="status" value="Status Tampilan" />
                                    <select id="status" wire:model="status" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 transition-colors">
                                        <option value="active">Aktif (Tampil di Web)</option>
                                        <option value="inactive">Nonaktif (Sembunyikan)</option>
                                    </select>
                                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <x-label value="Cover Image" />
                                    
                                    <div class="mt-1 flex items-center gap-4">
                                        @if ($new_cover_image)
                                            <img src="{{ $new_cover_image->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg border border-zinc-200">
                                        @elseif ($cover_image)
                                            <img src="{{ asset($cover_image) }}" class="w-16 h-16 object-cover rounded-lg border border-zinc-200">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-400">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <input type="file" wire:model="new_cover_image" id="cover_image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors" accept="image/*">
                                            <div wire:loading wire:target="new_cover_image" class="text-xs text-primary-600 mt-1 font-medium">Mengunggah...</div>
                                        </div>
                                    </div>
                                    @error('new_cover_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-4 md:col-span-2">
                                <div>
                                    <x-label for="description" value="Deskripsi Singkat" />
                                    <textarea id="description" wire:model="description" rows="3" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 transition-colors" placeholder="Jelaskan secara singkat mengenai isu ini..."></textarea>
                                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <x-label for="icon_svg" value="Icon SVG (Opsional, untuk desain spesifik)" />
                                    <textarea id="icon_svg" wire:model="icon_svg" rows="2" class="bg-zinc-100 focus:bg-white border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm w-full py-2.5 px-3 text-zinc-900 font-mono text-sm transition-colors" placeholder="<svg>...</svg>"></textarea>
                                    <p class="text-xs text-zinc-500 mt-1">Anda bisa menempelkan kode SVG dari Heroicons atau ikon lainnya.</p>
                                    @error('icon_svg') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-zinc-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-zinc-200">
                        <x-button target="store" type="submit" class="w-full sm:ml-3 sm:w-auto">
                            Simpan
                        </x-button>
                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-lg border border-zinc-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
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
            showModal: false,
            isFinished: false,
            get progressPercentage() {
                if (this.total === 0) return 0;
                return Math.round((this.processed / this.total) * 100);
            }
        }"
        x-show="showModal"
        x-init="$watch('isDeleting', value => { if (value) { showModal = true; isFinished = false; } })"
        @batch-delete-started.window="$wire.processNextChunk()"
        @chunk-processed.window="$wire.processNextChunk()"
        @batch-delete-finished.window="
            isFinished = true;
            selectionMode = false;
        "
        x-cloak
        class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-zinc-900/75 backdrop-blur-sm transition-opacity" @click="if(isFinished) showModal = false"></div>
        <div class="relative bg-white rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl transform transition-all text-center" @click.outside="if(isFinished) showModal = false">
            
            <template x-if="!isFinished">
                <div>
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
                        <button type="button" wire:click="cancelBatchDelete" @click="showModal = false" class="text-sm text-red-600 hover:text-red-800 font-medium px-4 py-2 hover:bg-red-50 rounded-lg transition-colors">
                            Batalkan Sisa Proses
                        </button>
                    </div>
                </div>
            </template>

            <template x-if="isFinished">
                <div>
                    <div class="mb-6">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-2">Proses Selesai</h3>
                    <p class="text-sm text-zinc-600 mb-6">
                        Berhasil menghapus <strong x-text="success" class="text-green-600"></strong> item.
                        <template x-if="failed > 0">
                            <span class="block mt-1"><strong x-text="failed" class="text-red-600"></strong> item batal dihapus karena masih digunakan.</span>
                        </template>
                    </p>
                    
                    <div class="mt-6">
                        <button type="button" @click="showModal = false; selectionMode = false" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>

        </div>
    </div>

    <!-- Floating Action Bar for Bulk Actions -->
    @if(count($selectedItems) > 0)
    <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40 bg-zinc-900 rounded-full shadow-2xl border border-zinc-700 p-2 pl-4 pr-2 flex justify-between items-center transition-all duration-300">
        <div class="text-sm font-medium text-white flex items-center gap-3 mr-6">
            <span class="bg-primary-500 text-white py-0.5 px-2 rounded-md font-bold">{{ count($selectedItems) }}</span> item
        </div>
        <div class="flex items-center gap-2">
            <button @click="$dispatch('open-confirm-modal', {
                    title: 'Konfirmasi Hapus',
                    message: 'Hapus ' + $wire.selectedItems.length + ' isu terpilih? Isu yang sedang digunakan oleh publikasi atau acara akan batal dihapus.',
                    confirmText: 'Hapus',
                    onConfirm: () => $wire.startBatchDelete()
                })" 
                wire:loading.attr="disabled" class="inline-flex items-center justify-center p-2 bg-red-600 hover:bg-red-500 text-white rounded-full transition shadow-sm disabled:opacity-50" title="Hapus Terpilih">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
            <div class="h-6 w-px bg-zinc-700 mx-1"></div>
            <button @click="selectionMode = false; $wire.cancelBatchDelete()" class="inline-flex items-center justify-center p-2 hover:bg-zinc-800 text-zinc-400 hover:text-white rounded-full transition" title="Batal">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
    @endif
</div>
