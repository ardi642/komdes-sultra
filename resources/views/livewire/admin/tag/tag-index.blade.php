<div class="space-y-6" x-data="{ selectionMode: false }">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-zinc-900">Manajemen Tag Global</h1>
        <div class="flex items-center gap-3">
            <button @click="selectionMode = !selectionMode; if(!selectionMode) { $wire.cancelBatchDelete() }" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-300 rounded-lg font-semibold text-xs text-zinc-700 uppercase tracking-widest hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition shadow-sm" :class="{'bg-primary-50 border-primary-300 text-primary-700': selectionMode}">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span x-text="selectionMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
            </button>
            <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Tag
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Top Action Bar (Search & Filters) -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4">
            <!-- Left: Search -->
            <div class="w-full sm:max-w-xs relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari tag..." class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm block w-full pl-9 py-2 transition-colors">
            </div>

            <!-- Right: Filters & Per Page -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="w-full sm:w-auto">
                    <x-tom-select wire:model.live="filterAuthor" :multiple="false" placeholder="Semua Pembuat" class="w-full bg-white text-sm border-zinc-300 rounded-lg">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </x-tom-select>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-zinc-600 hidden sm:inline">Tampil:</span>
                    <select wire:model.live="perPage" class="bg-zinc-100 focus:bg-white text-sm border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm py-2 pl-3 pr-8 text-zinc-900 transition-colors">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="overflow-x-auto relative">
                    <div wire:loading.flex class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-sm rounded-lg">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <table wire:loading.class="opacity-50 pointer-events-none" class="w-full text-sm text-left text-zinc-600">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th scope="col" class="p-4 w-4" x-show="selectionMode" x-transition>
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox" wire:model.live="selectAll" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer">
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">Nama Tag</th>
                        <th scope="col" class="px-6 py-3 font-medium">Slug</th>
                        <th scope="col" class="px-6 py-3 font-medium">Pembuat</th>
                        <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($tags as $tag)
                    <tr wire:key="tag-{{ $tag->id }}" class="hover:bg-zinc-50 transition-colors {{ in_array((string)$tag->id, $selectedItems) ? 'bg-primary-50/50' : '' }}">
                        <td class="p-4 w-4" x-show="selectionMode" x-transition>
                            <div class="flex items-center">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $tag->id }}" class="w-4 h-4 text-primary-600 bg-zinc-100 border-zinc-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer">
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-zinc-900">{{ $tag->name }}</td>
                        <td class="px-6 py-4 text-zinc-500">{{ $tag->slug }}</td>
                        <td class="px-6 py-4 text-zinc-500 font-medium">{{ $tag->user?->name ?? 'Sistem' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            @if(!auth()->user()->hasRole('Mitra Media') || $tag->user_id === auth()->id())
                                <button wire:click="edit({{ $tag->id }})" class="text-blue-600 hover:text-blue-900 font-medium">Edit</button>
                                <button wire:click="delete({{ $tag->id }})" onclick="confirm('Apakah Anda yakin ingin menghapus tag ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr wire:key="empty-row">
                        <td colspan="10" class="px-6 py-8 text-center text-zinc-500">Belum ada tag yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-zinc-200">
            {{ $tags->links() }}
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
            <div class="relative inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-50">
                <form wire:submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <h3 class="text-lg leading-6 font-medium text-zinc-900" id="modal-title">
                                {{ $tag_id ? 'Edit Tag' : 'Tambah Tag Baru' }}
                            </h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <x-label for="name" value="Nama Tag" />
                                <x-input id="name" type="text" wire:model.live="name" placeholder="Misal: Dana Desa" />
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <x-label for="slug" value="Slug (Otomatis)" />
                                <x-input id="slug" type="text" wire:model="slug" class="bg-zinc-100" readonly />
                                @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-zinc-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-zinc-200">
                        <x-button type="submit" class="w-full sm:ml-3 sm:w-auto">
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
                    message: 'Hapus ' + $wire.selectedItems.length + ' tag terpilih? Tag yang sedang digunakan oleh publikasi atau acara akan batal dihapus.',
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
